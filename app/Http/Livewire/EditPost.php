<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    use WithFileUploads;
    public $post;
    public $open = false;
    public $image,$identify;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
        'post.image' => 'required',
    ];

    public function save()
    {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }
        $this->post->save();
        $this->reset(['open','image']);        
        $this->identify = rand();
        $this->emit('render');
        $this->emit('alert', 'Post actualizo satisfactoriamente');
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->identify = rand();
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
