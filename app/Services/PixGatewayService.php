<?php

namespace App\Services;

use App\Models\Pedido;
use Illuminate\Support\Str;

class PixGatewayService
{
    /**
     * Gera uma nova cobrança PIX.
     * Numa aplicação real, este método conteria a chamada à API do gateway (PagSeguro, Mercado Pago, etc.).
     *
     * @param Pedido $pedido O pedido para o qual a cobrança será gerada.
     * @return array Um array contendo os dados da cobrança PIX.
     */
    public function gerarCobranca(Pedido $pedido): array
    {
        // --- SIMULAÇÃO DA RESPOSTA DO GATEWAY ---
        // Aqui, você usaria o SDK do gateway para enviar o valor do pedido,
        // os dados do cliente, e receberia de volta os dados do PIX.

        $gatewayTransactionId = 'pi_' . Str::random(24);
        $pixCopiaCola = '00020126330014br.gov.bcb.pix0111' . $pedido->id . '5204000053039865802BR5913' . $pedido->nome_cliente . '6009SAO PAULO62070503***6304' . Str::upper(Str::random(4));
        
        // Usamos um serviço externo para gerar a imagem do QR Code a partir do "copia e cola"
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($pixCopiaCola);

        // Retorna um array estruturado com a resposta simulada do gateway.
        return [
            'gateway_id'     => $gatewayTransactionId,
            'qr_code'        => $qrCodeUrl, // A URL da imagem do QR Code
            'copia_cola'     => $pixCopiaCola,
        ];
    }
}

