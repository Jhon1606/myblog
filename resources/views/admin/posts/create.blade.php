@extends('adminlte::page')

@section('title', 'CodersFree')

@section('content_header')
    <h1>Crear publicación</h1>
@endsection

@section('content')   
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
                @include('admin.posts.partials.form', [
                    'issetPost' => false,
                ])
                <button class="btn btn-primary btn-sm float-right" type="submit">Crear Post</button>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('js')
    {{-- Este es un plugin para poder trabajar en los textarea como si fuera formato Word --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#extract'))
            .catch( error => {
                console.error( error );
            } );

        ClassicEditor
        .create(document.querySelector('#body'))
        .catch( error => {
            console.error( error );
        } );

        //$("#file").change(function(event) { ... }): Esto establece un listener para el evento change en el elemento con el id "file". Cuando cambia el archivo seleccionado, se ejecuta la función proporcionada.
        // var file = event.target.files[0];: Aquí se obtiene el archivo seleccionado.
        // var reader = new FileReader();: Se crea un objeto FileReader para leer el contenido del archivo.
        // reader.onload = function(event) { ... }: Se define una función que se ejecutará cuando el archivo se haya cargado correctamente.
        // $("#picture").attr("src", event.target.result);: Esto cambia el atributo "src" del elemento con el id "picture" al resultado de la lectura del archivo.
        $("#file").change(function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            
            reader.onload = function(event) {
                $("#picture").attr("src", event.target.result);
            };
            
            reader.readAsDataURL(file);
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#name').on('input', function() {
                var name = $(this).val().trim().toLowerCase()
                    .replace(/\s+/g, '-') // Reemplazar espacios con guiones
                    .replace(/[^a-z0-9\-]/g, ''); // Eliminar caracteres especiales
                $('#slug').val(name);
            });
        });
    </script>
@endsection