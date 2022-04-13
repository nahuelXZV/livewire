<div>

    <x-jet-danger-button wire:click="$set('open',true)">
        Crear nuevo Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name='title'>
            Crear un nuevo post
        </x-slot>
        <x-slot name='content'>
            <div wire:loading wire:target='image'
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que el proceso termine.</span>
            </div>
            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @endif

            <div class="mb-4">
                <x-jet-label value='Titulo del post' />
                <x-jet-input type='text' class="w-full" wire:model.defer='title' />
                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value='Contenido del post' />
                <textarea wire:model.defer='content'
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    rows="10"></textarea>
                <x-jet-input-error for="content" />
            </div>

            <div>
                <input type="file" wire:model='image' id="{{$identify}}">
                <x-jet-input-error for="image" />
            </div>

        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click='save' wire:loading.attr='disabled' wire:target='save,image'
                class="disabled:opacity-15">
                Crear post
            </x-jet-danger-button>
            <span wire:loading wire:target='save'>Cargando...</span>
        </x-slot>
    </x-jet-dialog-modal>


</div>
