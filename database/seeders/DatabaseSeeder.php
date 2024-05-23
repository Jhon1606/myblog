<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // Le decimos que al ejecutar el seeder se elimine la carpeta posts de las imágenes con el método 
        // deleteDirectory para evitar que cada vez que se ejecute se creen 
        // más imágenes (Al ejecutar los seeders no se eliminan las imágenes, 
        // el resto de datos sí, como las categorías, tags, etc)
        Storage::deleteDirectory('public/posts');
        // Llamamos a el package storage para poder crear una nueva carpeta con el método makeDirectory 
        // y al principio siempre se pondrá el public para que ingrese a esa carpeta, 
        // sino sale error pq no la encuentra
        Storage::makeDirectory('public/posts');
        $this->call(UserSeeder::class);
        Category::factory(4)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
        // Al ejecutar php artisan migrate:fresh --seed elimina todos los datos y los vuelve a crear
        // Y se ejecutan los seeders, los seeders llaman a el factory mediante el metodo factory() para
        // crear respectivos datos con los parametros dados en los factories como por ejemplo 
        // 'name' = $this->faker->unique()->word(20); en el modelo tags
    }
}
