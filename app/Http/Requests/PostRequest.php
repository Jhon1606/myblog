<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {   // En caso se mande el user_id por el formulario, asi se valida que 
        //el id del usuario sea el mismo id de usuario que esta logueado

        if($this->user_id == auth()->user()->id){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $post = $this->route()->parameter('post');

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'status' => 'required|in:1,2', // Solo se puede mandar el valor de 1 y 2
            'file' => 'image'
        ];

        if($this->status == 2){
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
