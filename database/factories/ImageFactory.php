<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Se define la url para que se guarde la imagen en la carpeta storage, 
            // como segundo parametro se pone los px (640) y tercer (480) el alto
            'url' => 'posts/'.$this->faker->image('public/storage/posts', 640, 480, null, false) //posts/imagen.jpg
        ];
    }
}
