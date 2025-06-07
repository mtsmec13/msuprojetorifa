
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gateway;

class GatewayController extends Controller
{
    public function index()
    {
        $gateways = Gateway::all();
        return view('admin.gateways.index', compact('gateways'));
    }

    public function edit($id)
    {
        $gateway = Gateway::findOrFail($id);
        return view('admin.gateways.edit', compact('gateway'));
    }

    public function update(Request $request, $id)
    {
        $gateway = Gateway::findOrFail($id);
        $gateway->update($request->only([
            'nome', 'status', 'client_id', 'client_secret', 'chave_pix', 'webhook_url'
        ]));

        return redirect()->route('admin.gateways.index')->with('success', 'Gateway atualizado com sucesso!');
    }
}
