<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Select extends Component
{
    public $pais, $ciudad;

    public function render()
    {

        return view('livewire.select');
    }
}
