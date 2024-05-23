@extends('adminlte::page')

@section('title', 'CodersFree')

@section('content_header')
    {{-- Con float-right decimos que lo ubique de lado derecho --}}
    <button class="btn btn-secondary btn-sm float-right" id="modalCrear">Agregar Etiqueta</button>

    <h1>Lista de etiquetas</h1>
@stop

@section('content')
    {{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif --}}
    <script>
        Swal.fire({
            title: "The Internet?",
            text: "That thing is still around?",
            icon: "question"
        });
    </script>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->color}}</td>
                            <td width="10px">
                                {{-- Se deja como tag y no como tag->id para que no retorne el id en la url si no el slug,
                                    como se definió en el modelo Category con el metodo getRouteKeyName()--}}
                                    <button onclick="modalEditTag({{$tag->id}})" type="button" class="btn btn-primary btn-sm">
                                        Editar
                                    </button>
                            </td>
                            <td width="10px">
                                {{-- Para hacer el delete siempre se tendra que hacer dentro de un form, decirle que es metodo post
                                    y despues convertirlo en metodo delete mediante @method --}}
                                <form action="{{route('admin.tags.destroy', $tag)}}" method="POST">
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
    {{-- Partimos desde admin porque el ingresa a la carpeta views, desde ahi buscamos la ruta de la vista  --}}
    @include('admin.tags.create')
    @include('admin.tags.edit')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="{{ asset('resources/js/app.js')}}"></script>
    <script>
        $('#modalCrear').click( () => {
            // Realiza la petición Ajax para obtener los datos del controlador
            $.ajax({
                url: "{{ route('admin.tags.create') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // Limpia el select antes de agregar nuevas opciones
                    $('#color').empty();
                    
                    // Itera sobre los datos recibidos y agrega opciones al select
                    $.each(response, function(key, value) { 
                        $('#color').append($('<option>', {
                            value: key,  // La clave del color, Ej: red,blue
                            text: value  // El valor del color, Ej: Color rojo,Color azul
                        }));
                    });
                    
                    // Abre el modal cuando se recibe la respuesta exitosamente
                    $('#modalCreateTag').modal('show');
                },
                error: function(xhr, status, error) {
                    // Maneja los errores si la petición falla
                    console.error('Error:', error);
                }
            });
        })

        function modalEditTag(tag){
            console.log(tag);
            $.ajax({
                url: "{{ route('admin.tags.edit', ['tag' => ':tag']) }}".replace(':tag', tag),
                type: "GET",
                success: function(response) {
                    console.log(response.color);
                    $('#editId').val(response.id);
                    $('#editName').val(response.name);

                    // Vaciar el select antes de agregar nuevas opciones
                    $('#editColor').empty();

                    // Agregar la opción del color actual en el campo select
                    $('#editColor').append($('<option>', {
                        value: response.color,
                        // Acá accedemos a el arreglo de colores que traemos del controlador, Ej: 'blue' => 'Color azul'
                        text: response.colors[response.color] 
                    }));

                    // Acceder al array de colores desde la respuesta
                    var colors = response.colors;
                    console.log(colors);
                    
                    // Itera sobre los datos recibidos y agrega opciones al select
                    $.each(colors, function(key, value) { 
                        $('#editColor').append($('<option>', {
                            value: key,  // La clave del color, Ej: red,blue
                            text: value  // El valor del color, Ej: Color rojo,Color azul
                        }));
                    });

                $('#modalEditTag').modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        } 

    </script>
@endsection