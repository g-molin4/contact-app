<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Contato') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Mensagens de erro -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded dark:text-red-200">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Mensagem de sucesso -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulário de edição -->
                <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="space-y-6" id="edit-contact-form">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', $contact->name) }}" 
                               required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $contact->email) }}" 
                               required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <div>
                        <label for="number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                        <input type="text" name="number" id="number" 
                               value="{{ old('number', $contact->number) }}" 
                               required pattern="\d{9}" title="Digite 9 dígitos"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                </form>

                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this contact?')" id="delete-contact-form">
                        @csrf
                        @method('DELETE')
                </form>
                <div class="flex justify-between items-center mt-6">
                    <!-- Botão Voltar -->
                    <a href="{{ route('contacts.index') }}" 
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500">
                        Voltar
                    </a>

                    <div class="flex space-x-3">
                        <!-- Botão Excluir -->
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600" form="delete-contact-form">
                                Excluir
                            </button>

                        <!-- Botão Salvar Alterações -->
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" form="edit-contact-form">
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>