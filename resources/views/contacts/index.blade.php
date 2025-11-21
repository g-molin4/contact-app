
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contatos') }}
            </h2>
            <a href="{{ route('contacts.create') }}" 
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Adicionar Contato
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded dark:text-white-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 dark:text-white">
                @if($contacts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($contacts as $contact)
                            <div class="p-4 border rounded-lg bg-gray-50 dark:bg-gray-700">
                                <h3 class="text-lg font-semibold">{{ $contact->name }}</h3>
                                <p><strong>Email:</strong> {{ $contact->email }}</p>
                                <p><strong>Telefone:</strong> {{ $contact->number }}</p>
                                @auth
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('contacts.edit', $contact->id) }}" 
                                        class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Editar
                                        </a>

                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" 
                                            onsubmit="return confirm('Deseja realmente excluir este contato?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300 dark:text-white-200">Nenhum contato cadastrado.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>