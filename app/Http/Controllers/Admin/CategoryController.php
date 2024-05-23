<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Termwind\Components\Dd;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'slug' => 'required|unique:categories'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')->with('info', 'La categoría se ha creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category)
    {
        $category = Category::find($category);
        // return view('admin.categories.edit', compact('category'));
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // $request->validate([
        //     'name' => 'required',
        // //     // 'slug' => 'required|unique:categories'
        // ]);
        
        // No debería ser asi, pero será de manera temporal, debo utilizar el Category que recibo en el form
        // Mientras utilizaré el que se envía por el request
        $category = Category::find($request->editId);

        $category->name = $request->editName;
        $category->slug = Str::slug($request->editName);
        $category->save();

        return redirect()->route('admin.categories.index')->with('info', 'La categoría se ha actualizado con éxito');
    }

    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('info','La categoría se eliminó con éxito');
    }
}
