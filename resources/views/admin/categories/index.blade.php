@extends('adminlte::page')

@section('title', 'CodersFree')

@section('content_header')
    <h1>Lista de categorias</h1>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalCreateCategory">
                Agregar Categoria
            </button>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td width="10px">
                                {{-- Se deja como category y no como category->id para que no retorne el id en la url si no el slug,
                                    como se definió en el modelo Category con el metodo getRouteKeyName()--}}
                                    <button onclick="modalEditCategory({{$category->id}})" type="button" class="btn btn-primary btn-sm">
                                        Editar
                                    </button>
                            </td>
                            <td width="10px">
                                {{-- Para hacer el delete siempre se tendra que hacer dentro de un form, decirle que es metodo post
                                    y despues convertirlo en metodo delete mediante @method --}}
                                <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class=" btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
    @include('admin.categories.create')
    @include('admin.categories.edit')
@endsection

@section('js')
    <script> 
        function modalEditCategory(category){
            console.log(category);
            $.ajax({
                url: "{{ route('admin.categories.edit', ['category' => ':category']) }}".replace(':category', category),
                type: "GET",
                success: function(response) {
                    console.log(response.id);
                    $('#editId').val(response.id);
                    $('#editName').val(response.name);
                    $('#modalEditCategory').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }  
    </script>
@endsection




