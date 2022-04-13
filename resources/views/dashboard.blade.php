<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12"">
            
            @livewire('show-posts')
            @livewire('select')
            
        </div>
    </div>
</x-app-layout>
