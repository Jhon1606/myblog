<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;
    // Con esto le decimos que muestre la paginación con el estilo de bootstrap y no el de Tailwindcss
    protected $paginationTheme = "bootstrap";
    // Esto es para que en el input donde tenemos el wire:model.live, pueda buscar dicho post
    public $search;
    // Este método se utiliza para resetear la página y que muestre los datos
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        // Con auth()->user()->id recuperamos el id del usuario que esta logueado
        $posts = Post::where('user_id', auth()->user()->id)
                        // Acá le decimos que busque en la bd el nombre que pone en el buscador, y que puede 
                        // empezar con el mismo, el Like se agrega para que lo busque
                        ->where('name','LIKE','%'.$this->search.'%')
                        ->latest('id')
                        ->paginate();
        return view('livewire.admin.posts-index', compact('posts'));
    }
}
