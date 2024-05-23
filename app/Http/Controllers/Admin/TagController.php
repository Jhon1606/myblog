<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $colors = [
        'red' => 'Color rojo',
        'yellow' => 'Color amarillo',
        'green' => 'Color verde',
        'blue' => 'Color azul',
        'indigo' => 'Color indigo',
        'purple' => 'Color morado',
        'pink' => 'Color rosado',
    ];
        return response()->json($colors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags',
            // 'slug' => 'required|unique:tags'
            'color' => 'required'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color
        ]);
        
        return redirect()->route('admin.tags.index')->with('info', 'La etiqueta fue creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tag)
    {
        $tag = Tag::find($tag);
        $colors = [
            'red' => 'Color rojo',
            'yellow' => 'Color amarillo',
            'green' => 'Color verde',
            'blue' => 'Color azul',
            'indigo' => 'Color indigo',
            'purple' => 'Color morado',
            'pink' => 'Color rosado',
        ];
        // Agregar los colores al tag antes de enviar la respuesta, de esta forma mandamos los 2 arrays en un solo dato
        $tag->colors = $colors;
        return response()->json($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $tag = Tag::find($request->id);
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->color = $request->color;
        $tag->save();

        // Establece el mensaje en la sesión flash
       
        return redirect()->route('admin.tags.index')->with('info', 'La etiqueta se ha actualizado con éxito');
    }
    
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info','La etiqueta se eliminó con éxito');
    }
}
