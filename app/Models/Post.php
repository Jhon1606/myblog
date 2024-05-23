<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Para definir el guarded es para asignar los valores que se va a evitar que se llenen por asignación masiva
    // Este se utiliza para cuando hay muchos campos a guardar y pocos que no queremos que se guarden (los que van en el guarded)
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory;

    //Relación uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relación muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // Relación uno a uno polimorfica
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
