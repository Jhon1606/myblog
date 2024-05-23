<div class="card">
    <div class="card-header">
        {{-- Con el wire:model.live le decimos que lo que escribamos en el input se guarde en la variable
            search que tenemos en el archivo PostsIndex.php creado con livewire --}}
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre de un post">
    </div>
    {{-- Si existe un registro, entonces muestra los 2 div --}}
    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->name}}</td>
                            <td width="10px">
                                <a href="{{route('admin.posts.edit', $post)}}" class="btn btn-primary btn-sm"> Editar </a>
                            </td>
                            <td width="10px">
                                {{-- Para hacer el delete siempre se tendra que hacer dentro de un form, decirle que es metodo post
                                    y despues convertirlo en metodo delete mediante @method --}}
                                <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
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
        <div class="card-footer">
            {{$posts->links()}}
        </div>
    {{-- Si no hay ningun registro muestra este div --}}
    @else
    <div class="card-body">
        <strong>No hay ningún registro...</strong>
    </div>    
    @endif
</div>  

