<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao;

class AdminConfigController extends Controller
{
    public function index()
    {
        $config = [];
        foreach([
            'site_nome', 'site_logo', 'site_favicon', 'site_cor_primaria', 'site_descricao', 
            'site_regras', 'site_redes_sociais', 'banner_home', 'texto_home'
        ] as $chave) {
            $config[$chave] = Configuracao::get($chave);
        }
        return view('admin.config.index', compact('config'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_nome' => 'required|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:512',
            'site_cor_primaria' => 'nullable|string|max:20',
            'site_descricao' => 'nullable|string|max:500',
            'site_regras' => 'nullable|string|max:2000',
            'site_redes_sociais' => 'nullable|string|max:2000',
            'banner_home' => 'nullable|image|max:4096',
            'texto_home' => 'nullable|string|max:1000',
        ]);
        // Uploads
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('logos', 'public');
            Configuracao::set('site_logo', '/storage/' . $path);
        }
        if ($request->hasFile('site_favicon')) {
            $path = $request->file('site_favicon')->store('favicons', 'public');
            Configuracao::set('site_favicon', '/storage/' . $path);
        }
        if ($request->hasFile('banner_home')) {
            $path = $request->file('banner_home')->store('banners', 'public');
            Configuracao::set('banner_home', '/storage/' . $path);
        }

        // Textos e outras configs
        foreach([
            'site_nome', 'site_cor_primaria', 'site_descricao',
            'site_regras', 'site_redes_sociais', 'texto_home'
        ] as $chave) {
            Configuracao::set($chave, $request->input($chave));
        }

        return redirect()->back()->with('success', 'Configurações salvas!');
    }
}
```

---

## 11. `app/Http/Controllers/PublicRifaController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Rifa;

class PublicRifaController extends Controller
{
    public function index()
    {
        $rifas = Rifa::orderBy('created_at', 'desc')->get();
        return view('public.rifas.index', compact('rifas'));
    }

    public function show(Rifa $rifa)
    {
        $compras = $rifa->compras()->orderBy('numero')->get();
        $vencedores = [];
        for ($i=1; $i<=3; $i++) {
            $num = $rifa->{'numero_sorteado_'.$i};
            $premio = $rifa->{'premio_'.$i};
            $ganhador = $num ? $compras->where('numero', $num)->first() : null;
            if ($num && $premio) {
                $vencedores[] = [
                    'colocacao' => $i,
                    'numero' => $num,
                    'premio' => $premio,
                    'nome' => $ganhador ? $ganhador->nome : null,
                    'whatsapp' => $ganhador ? $ganhador->whatsapp : null,
                ];
            }
        }
        return view('public.rifas.show', compact('rifa', 'vencedores'));
    }
}