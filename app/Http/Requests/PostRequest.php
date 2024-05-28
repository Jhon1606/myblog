<?php

namespace App\Http\Requests;

use App\Models\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
        // En caso se mande el user_id por el formulario, asi se valida que 
        //el id del usuario sea el mismo id de usuario que esta logueado

        // if ($this->user_id == auth()->user()->id) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function rules()
    {
        // Obtén el post desde la ruta
        $post = $this->route('post');

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2', // Solo se puede mandar el valor de 1 y 2
            'file' => 'image'
        ];

        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        // Si el status es igual a 2 (Publicado) debe juntar los arreglos rules y el nuevo
        if ($this->status == 2) {
            // El array_merge es para unir 2 arrays, en caso que el status sea 2 se hace esto para agregar
            // más reglas de validación
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }
        return $rules;
    }
}
