
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Compra;

class WebhookController extends Controller
{
    public function pagbank(Request $request)
    {
        Log::info('Webhook PagBank recebido', $request->all());

        // Exemplo de lógica simplificada (substituir por validação real do PagBank)
        $txid = $request->input('txid');
        $compra = Compra::where('txid', $txid)->first();
        if ($compra && !$compra->pago) {
            $compra->pago = true;
            $compra->save();
        }

        return response()->json(['status' => 'ok']);
    }

    public function efi(Request $request)
    {
        Log::info('Webhook EFI recebido', $request->all());

        $txid = $request->input('txid');
        $compra = Compra::where('txid', $txid)->first();
        if ($compra && !$compra->pago) {
            $compra->pago = true;
            $compra->save();
        }

        return response()->json(['status' => 'ok']);
    }

    public function paggue(Request $request)
    {
        Log::info('Webhook Paggue recebido', $request->all());

        $txid = $request->input('txid');
        $compra = Compra::where('txid', $txid)->first();
        if ($compra && !$compra->pago) {
            $compra->pago = true;
            $compra->save();
        }

        return response()->json(['status' => 'ok']);
    }

    public function suitpay(Request $request)
    {
        Log::info('Webhook SuitPay recebido', $request->all());

        $txid = $request->input('txid');
        $compra = Compra::where('txid', $txid)->first();
        if ($compra && !$compra->pago) {
            $compra->pago = true;
            $compra->save();
        }

        return response()->json(['status' => 'ok']);
    }
}
