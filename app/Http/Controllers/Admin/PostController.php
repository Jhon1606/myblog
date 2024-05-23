<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    public function index()
    {   
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // En caso de que usáramos Laravel Collective
        // $categories = Category::pluck('name','id');
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
       
        $post = Post::create($request->all());

        if($request->file('file')){
            // Con Storage::put('posts', $request->file('file')) decimos que guarde el archivo en la carpeta public/storage/posts
            $url = Storage::put('public/posts', $request->file('file'));
            // Accedemos a la relación image y le decimos que guarde la url
            $post->image()->create([
                'url' => $url
            ]);
        }

        // Como la tabla post no tiene un campo llamado tags, sino que es una relación muchos a muchos, se llama
        // a la relación del modelo Post "tags()" para que el valor de tags lo agregue (con attach()) a la tabla post_tag que es el pivot (relación)
        if ($request->tags){
            $post->tags()->attach($request->tags);
        }
        

        //? Otra forma de hacerlo
        // $post = new Post();
        // $post->name = $request->name;
        // $post->slug = Str::slug($request->name);
        // $post->extract = $request->extract;
        // $post->body = $request->body;
        // $post->category_id = $request->category_id;
        // $post->tags = $request->tags;
        // $post->user_id = auth()->user()->id;

        return redirect()->route('admin.posts.index')->with('info','La publicación se ha creado exitosamente');
    }

    
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('tags', 'categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
