<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public $open = false;

    public $title, $content, $image, $identify;

    public function mount(){
        $this->identify = rand();
    }
    protected $rules = [
        'title' => 'required|max:100',
        'content' => 'required',
        'image' => 'required|image'
    ];
/*
    public function updated($propertyName){
        $this->validateonly($propertyName);
    }*/
    public function save(){
        $this->validate();
        $image = $this->image->store('posts');
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image,
        ]);
        $this->reset(['open','title','content','image']);
        $this->identify = rand();
        $this->emit('render');
        $this->emit('alert','Post creado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
