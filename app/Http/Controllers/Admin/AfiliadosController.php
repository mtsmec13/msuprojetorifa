
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliado;

class AfiliadosController extends Controller
{
    public function index()
    {
        $afiliados = Afiliado::with('afiliado', 'compra')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.afiliados.index', compact('afiliados'));
    }
}
