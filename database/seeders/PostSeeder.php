<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creamos una variable llamada post y guardamos los 100 post creados con el factory
        $posts = Post::factory(300)->create();

        // Luego hacemos un foreach, llamamos a el modelo image y luego el metodo factory para crear una imagen,
        // y le pasamos el id y el type recorriendo el arreglo
        foreach($posts as $post){
            Image::factory(1)->create([
                'imageable_id' => $post->id,
                'imageable_type' => Post::class
            ]);
            // Para hacer la relacion entre los posts y los tags
            // Llamamos a la variable post y accedemos a el metodo tags que se creo en el modelo Post, 
            // la relacion muchos a muchos
            $post->tags()->attach([
                rand(1, 4),
                rand(5, 8)
            ]);
        }
    }
}
