
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfiliadoController extends Controller
{
    public function meuLink()
    {
        $user = Auth::user();
        $link = url('/?ref=' . $user->id);
        return view('afiliado.link', compact('link'));
    }
}
