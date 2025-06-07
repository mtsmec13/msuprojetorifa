<x-app-layout>
    <div class="container mx-auto max-w-md p-4 pt-16 pb-24">
        <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-extrabold text-white text-center mb-6">Entrar na sua Conta</h1>
            
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
                    <input id="email" class="block mt-1 w-full bg-gray-900 border-gray-700 text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email')" required autofocus>
                </div>

                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-300">Senha</label>
                    <input id="password" class="block mt-1 w-full bg-gray-900 border-gray-700 text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password" required>
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-gray-900 border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-400">Lembrar-me</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-400 hover:text-gray-200" href="{{ route('password.request') }}">
                            Esqueceu a sua senha?
                        </a>
                    @endif

                    <button type="submit" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

