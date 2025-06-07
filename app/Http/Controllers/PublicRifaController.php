<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use App\Models\Numero;
use App\Models\Pedido;
use App\Services\PixGatewayService; // Importa o novo serviço
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PublicRifaController extends Controller
{
    /**
     * Exibe a lista de rifas ativas e finalizadas.
     */
    public function index()
    {
        $rifasAtivas = Rifa::withCount('numerosVendidos')->where('status', 'Ativo')->latest()->get();
        $rifasFinalizadas = Rifa::withCount('numerosVendidos')->where('status', 'Finalizada')->latest()->get();
        
        return view('public.rifas.index', compact('rifasAtivas', 'rifasFinalizadas'));
    }

    /**
     * Exibe os detalhes de uma rifa específica com a grade de números.
     */
    public function show(Rifa $rifa)
    {
        if ($rifa->status === 'Pausada') {
            abort(404, 'Rifa não encontrada.');
        }
        $rifa->load('numeros');
        return view('public.rifas.show', compact('rifa'));
    }

    /**
     * Processa a reserva e gera a cobrança PIX para utilizadores logados ou convidados.
     */
    public function reservar(Request $request, Rifa $rifa, PixGatewayService $pixGateway)
    {
        $isGuest = !Auth::check();
        $rules = ['numeros_selecionados' => 'required|string'];
        if ($isGuest) {
            $rules['nome'] = 'required|string|max:255';
            $rules['whatsapp'] = 'required|string|max:20';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => 'Dados inválidos.', 'messages' => $validator->errors()], 422);
        }

        $numerosSelecionados = json_decode($request->numeros_selecionados);
        if (empty($numerosSelecionados)) {
            return response()->json(['error' => 'Nenhum número selecionado.'], 400);
        }

        DB::beginTransaction();
        try {
            $numerosDisponiveis = Numero::where('rifa_id', $rifa->id)->whereIn('numero', $numerosSelecionados)->where('status', 'Disponivel')->lockForUpdate()->get();

            if (count($numerosDisponiveis) !== count($numerosSelecionados)) {
                DB::rollBack();
                return response()->json(['error' => 'Ops! Um ou mais números foram reservados enquanto você escolhia. Por favor, atualize a página e tente novamente.'], 409);
            }

            // Cria um pedido inicial com status 'processando'
            $pedido = Pedido::create([
                'rifa_id' => $rifa->id,
                'user_id' => Auth::id(),
                'nome_cliente' => $isGuest ? $request->nome : Auth::user()->name,
                'email_cliente' => $isGuest ? "convidado_" . Str::random(5) . "@site.com" : Auth::user()->email,
                'telefone_cliente' => $isGuest ? $request->whatsapp : (Auth::user()->whatsapp ?? null),
                'valor_total' => count($numerosDisponiveis) * $rifa->preco,
                'status' => 'processando', // Um status inicial
            ]);
            
            // **DELEGA A GERAÇÃO DO PIX PARA O SERVIÇO**
            $pixData = $pixGateway->gerarCobranca($pedido);

            // Atualiza o pedido com os dados recebidos do gateway
            $pedido->update([
                'status' => 'pendente',
                'gateway_id' => $pixData['gateway_id'],
                'pix_qr_code' => $pixData['qr_code'],
                'pix_copia_cola' => $pixData['copia_cola'],
                'expira_em' => now()->addMinutes(15),
            ]);

            // Atualiza o status dos números para 'Reservado'
            Numero::whereIn('id', $numerosDisponiveis->pluck('id'))->update(['status' => 'Reservado', 'pedido_id' => $pedido->id]);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'qr_code' => $pedido->pix_qr_code,
                'copia_cola' => $pedido->pix_copia_cola,
                'valor' => 'R$ ' . number_format($pedido->valor_total, 2, ',', '.'),
                'expira_em' => $pedido->expira_em->toIso8601String(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao gerar PIX: " . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.'], 500);
        }
    }
}

