
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegistrarAfiliado
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ref')) {
            session(['afiliado_ref' => $request->get('ref')]);
        }
        return $next($request);
    }
}
