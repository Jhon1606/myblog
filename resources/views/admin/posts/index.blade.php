@extends('adminlte::page')

@section('title', 'CodersFree')

@section('content_header')
    {{-- Con float-right decimos que lo ubique de lado derecho --}}
    <a href="{{route('admin.posts.create')}}" class="btn btn-secondary btn-sm float-right">Nuevo Post</a>
    <h1>Lista de publicaciones</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('admin.posts-index')
@stop

@section('css')
    
@stop

@section('js')
    <script>

    </script>
@endsection