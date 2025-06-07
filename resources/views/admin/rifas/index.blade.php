@extends('layouts.admin')

@section('title', 'Gestão de Rifas')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-white">Minhas Rifas</h2>
        <a href="#" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-lg flex items-center">
            <i data-feather="plus" class="w-5 h-5 mr-2"></i>
            Criar Nova Rifa
        </a>
    </div>

    <div class="bg-gray-800 border border-gray-700 rounded-lg p-1 overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-900">
                <tr>
                    <th class="p-4 font-semibold">Título</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold">Preço</th>
                    <th class="p-4 font-semibold">Progresso</th>
                    <th class="p-4 font-semibold text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Exemplo de rifa --}}
                <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                    <td class="p-4">iPhone 15 Pro Max</td>
                    <td class="p-4"><span class="px-2 py-1 text-xs font-bold rounded-full bg-green-500 text-white">Ativa</span></td>
                    <td class="p-4">R$ 5,00</td>
                    <td class="p-4">150 / 500 (30%)</td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="#" class="p-2 text-blue-400 hover:text-blue-300"><i data-feather="edit"></i></a>
                            <a href="#" class="p-2 text-yellow-400 hover:text-yellow-300"><i data-feather="users"></i></a>
                            <button class="p-2 text-red-500 hover:text-red-400"><i data-feather="trash-2"></i></button>
                        </div>
                    </td>
                </tr>
                {{-- Outras rifas... --}}
            </tbody>
        </table>
    </div>
@endsection

