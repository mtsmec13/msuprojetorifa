<x-app-layout>
    <div class="container mx-auto max-w-md p-4 pt-16 pb-24">
        <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-extrabold text-white text-center mb-6">Criar Nova Conta</h1>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-300">Nome</label>
                    <input id="name" class="block mt-1 w-full bg-gray-900 border-gray-700 text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="text" name="name" :value="old('name')" required autofocus>
                </div>

                <div class="mt-4">
                    <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
                    <input id="email" class="block mt-1 w-full bg-gray-900 border-gray-700 text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email')" required>
                </div>

                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-300">Senha</label>
                    <input id="password" class="block mt-1 w-full bg-gray-900 border-gray-700 text-gray-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password" required>
                </div>
                
                <div class="mt-4">
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-300">Confirmar Senha</label>
                    <input id="password_confirmation" class="block mt-1 w-full bg-gray-900 border-gray-700 text-gray-200 rounded-md shadow-sm" type="password" name="password_confirmation" required>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-400 hover:text-gray-200" href="{{ route('login') }}">
                        Já tem uma conta?
                    </a>

                    <button type="submit" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                        Registar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

