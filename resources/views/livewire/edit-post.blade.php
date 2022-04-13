<div>

    <a class="font-bold text-white rounded cursor-pointer bg-red-600 hover:bg-red-500 py-2 px-4 "
        wire:click="$set('open',true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model='open'>
        <x-slot name='title'>
            Editar el post
        </x-slot>

        <x-slot name='content'>

            <div wire:loading wire:target='image'
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que el proceso termine.</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @else
                <img src="{{ Storage::url($post->image) }}">
            @endif

            <div class="mb-4">
                <x-jet-label value='Titulo del post' />
                <x-jet-input wire:model='post.title' type='text' class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value='Contenido del post' />
                <textarea wire:model='post.content'
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    rows="10"></textarea>
            </div>

            <div>
                <input type="file" wire:model='image' id="{{ $identify }}">
                <x-jet-input-error for="image" />
            </div>

        </x-slot>  

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click='save' wire:loading.attr='disabled' class="disabled:opacity-15">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
