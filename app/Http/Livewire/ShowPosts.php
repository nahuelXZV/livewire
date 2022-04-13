<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $pagination = 10;
    //seccion edit
    public $open_edit = false;
    public $image, $identify, $post;

    //enviar datos por el url
    protected $queryString = [
        'pagination' => ['except' => '10'],
        'search' => ['except' => ''],
    ];
    protected $listeners = ['render' => 'render', 'delete' => 'delete'];

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
        'post.image' => 'required',
    ];

    //lo primero que se hace al llamar al componente
    public function mount()
    {
        $this->identify = rand();
        $this->post = new Post;
    }

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);

        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }
        $this->post->save();
        $this->reset(['open_edit', 'image']);
        $this->identify = rand();
        $this->emit('alert', 'Post actualizo satisfactoriamente');
    }

    //cada que se modifique el atributo search se realiza la siguiente funcion
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function delete(Post $post)
    {
        $post->delete();
    }
}
