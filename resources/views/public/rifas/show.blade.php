<x-app-layout>
  <div class="flex min-h-screen bg-gray-900 text-white">
    <!-- Sidebar -->
    <aside class="w-60 bg-gray-800 p-4 space-y-4">
      <div class="text-xl font-bold">Menu</div>
      <nav class="space-y-2">
        <a href="/rifas" class="block px-3 py-2 rounded bg-gray-700">Rifas</a>
        <a href="/sorteios" class="block px-3 py-2 rounded hover:bg-gray-700">Sorteios</a>
        <a href="/ranking" class="block px-3 py-2 rounded hover:bg-gray-700">Ranking</a>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6">
      <!-- Banner -->
      <div class="bg-black rounded-xl overflow-hidden shadow-lg mb-8">
        <img src="{{ $rifa->banner_url ?? 'https://via.placeholder.com/800x300' }}" class="w-full h-64 object-cover" alt="Banner da Rifa">
        <div class="p-4 text-center">
          <h1 class="text-3xl font-bold uppercase">{{ $rifa->titulo }}</h1>
          <div class="mt-2 text-2xl font-mono">
            <span id="countdown">12:34:56</span>
          </div>
        </div>
      </div>

      <!-- Grade de Números -->
      <div class="grid grid-cols-8 gap-3 text-center text-lg mb-6">
        @for ($i = 1; $i <= $rifa->quantidade_numeros; $i++)
          @php $ocupado = in_array($i, $numerosOcupados); @endphp
          <div class="px-3 py-2 rounded {{ $ocupado ? 'bg-green-600' : 'bg-gray-700 hover:bg-gray-600 cursor-pointer' }}">
            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
          </div>
        @endfor
      </div>

      <!-- Botão Participar -->
      <div class="text-center">
        <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg text-white text-lg font-semibold">
          PARTICIPAR
        </button>
      </div>
    </main>
  </div>

  <!-- Script de contagem regressiva -->
  <script>
    const countdown = document.getElementById('countdown');
    const endTime = new Date("{{ $rifa->data_sorteio ?? now()->addDays(1) }}").getTime();
    setInterval(() => {
      const now = new Date().getTime();
      const diff = endTime - now;
      const h = String(Math.floor(diff / (1000 * 60 * 60)) % 24).padStart(2, '0');
      const m = String(Math.floor(diff / (1000 * 60)) % 60).padStart(2, '0');
      const s = String(Math.floor(diff / 1000) % 60).padStart(2, '0');
      countdown.textContent = `${h}:${m}:${s}`;
    }, 1000);
  </script>
</x-app-layout>