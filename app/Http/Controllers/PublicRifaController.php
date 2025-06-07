<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Rifa;
use App\Models\Compra;

class PublicRifaController extends Controller
{
    /**
     * Exibe detalhes da rifa e status dos números.
     */
    public function show($id)
    {
        $rifa = Rifa::findOrFail($id);
        $compras = Compra::where('rifa_id', $rifa->id)->get();

        $vendas = [];
        foreach ($compras as $compra) {
            $vendas[$compra->numero] = $compra;
        }
        $numerosOcupados = $compras->pluck('numero')->toArray();

        $premios = is_file(storage_path('app/premios.json'))
            ? json_decode(Storage::disk('local')->get('premios.json'), true)
            : [];

        // Ranking por usuário (opcional, só se tiver user_id na tabela compras)
        $ranking = [];
        if (Compra::schema()->hasColumn('user_id')) {
            $ranking = Compra::where('rifa_id', $rifa->id)
                ->selectRaw('user_id, count(*) as total_comprado')
                ->groupBy('user_id')
                ->orderByDesc('total_comprado')
                ->with('user')
                ->get();
        }

        return view('public.rifas.show', [
            'rifa' => $rifa,
            'vendas' => $vendas,
            'premios' => $premios,
            'numerosOcupados' => $numerosOcupados,
            'ranking' => $ranking,
        ]);
    }

    /**
     * Reserva número e gera cobrança Pix no PagBank.
     */
    public function reservarPixPagbank(Request $request, $id)
    {
        $request->validate([
            'numero' => 'required|integer|min:1',
        ]);

        $numero = $request->numero;
        $rifa = Rifa::findOrFail($id);

        // Protege contra reserva duplicada
        if (Compra::where('rifa_id', $id)->where('numero', $numero)->exists()) {
            return back()->with('erro', 'Número já ocupado!');
        }

        // Cria compra pendente
        $compra = Compra::create([
            'rifa_id' => $id,
            'numero' => $numero,
            'user_id' => auth()->id(),
            'status' => 'aguardando_pix',
        ]);

        // Monta cobrança Pix PagBank
        $url = env('PAGSEGURO_PIX_SANDBOX')
            ? 'https://sandbox.api.pagseguro.com/pix/v2/cob'
            : 'https://api.pagseguro.com/pix/v2/cob';

        $headers = [
            'Authorization' => 'Bearer ' . env('PAGSEGURO_PIX_TOKEN'),
            'Content-Type' => 'application/json',
        ];

        $body = [
            'calendario' => ['expiracao' => 3600],
            'devedor' => [
                'cpf' => '12345678909', // Troque pelo CPF real do usuário
                'nome' => auth()->user()->name ?? 'Cliente'
            ],
            'valor' => ['original' => number_format($rifa->preco, 2, '.', '')],
            'chave' => env('PAGSEGURO_PIX_KEY'),
            'solicitacaoPagador' => "Pagamento da rifa {$rifa->nome}, número $numero"
        ];

        $response = Http::withHeaders($headers)->post($url, $body);

        if ($response->successful()) {
            $data = $response->json();
            $compra->update([
                'txid' => $data['txid'] ?? null,
                'loc' => $data['loc']['id'] ?? null,
            ]);

            // Busca o QR Code
            $qrUrl = (env('PAGSEGURO_PIX_SANDBOX')
                ? 'https://sandbox.api.pagseguro.com/pix/v2/loc/'
                : 'https://api.pagseguro.com/pix/v2/loc/'
            ) . $data['loc']['id'] . '/qrcode';

            $qrResponse = Http::withHeaders($headers)->get($qrUrl);
            $qrData = $qrResponse->json();

            return view('public.rifas.pix', [
                'qrcode' => $qrData['qrcode'] ?? '',
                'imagem' => $qrData['imagemQrcode'] ?? '',
                'compra' => $compra,
                'rifa' => $rifa
            ]);
        } else {
            return back()->with('erro', 'Erro ao gerar cobrança Pix PagBank: ' . $response->body());
        }
    }

    /**
     * Webhook: recebe notificação de pagamento Pix do PagBank.
     */
    public function pagbankPixWebhook(Request $request)
    {
        $payload = $request->all();
        $txid = $payload['pix'][0]['txid'] ?? null;
        if ($txid) {
            $compra = Compra::where('txid', $txid)->first();
            if ($compra) {
                $compra->status = 'aprovado';
                $compra->save();
            }
        }
        return response('ok');
    }
    
}