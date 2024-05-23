<x-app-layout>
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-8">
        {{-- con el md:grid-cols-2 le decimos que ocupe 2 columnas en pantalla mediana 
            (md=pantalla mediana, lg=pantalla grande)--}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                {{-- El modelo post tiene relacion con la imagen mediante el metodo Image, accedemos desde post
                al image y luego a la url ($post->image->url) --}}
            @if ($post->image)
                <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url({{ Storage::url($post->image->url)}})">
            @else
                <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url(https://cdn.pixabay.com/photo/2023/08/18/15/02/cat-8198720_1280.jpg)">
            @endif
                    <div class="w-full h-full px-8 flex flex-col justify-center">
                        <div>
                            {{-- Como es una relacion muchos a muchos, entonces tienen muchos tags, por esa razon
                                se hace el foreach, se llama el metodo tags del modelo post, se accede a 
                                ella mediante el post_tag, ya que hacemos referencia
                                en el archivo de migración create_post_tag_table que el post_id y el tag_id
                                hace referencia a sus respectivos ids en las tablas posts y tags --}}
                            @foreach ($post->tags as $tag)
                                <a href="{{route('posts.tag', $tag)}}" class="inline-block px-3 h-6 bg-{{$tag->color}}-600 text-white rounded-full">{{$tag->name}}</a>
                            @endforeach
                        </div>
                        <h1 class="text-4xl text-while leading-8 font-bold">
                            <a href="{{route('posts.show', $post->id)}}">
                                {{ $post->name }}
                            </a>
                        </h1>
                    </div>
                </article>
            @endforeach

        </div>

        {{-- Paginación --}}
        <div class="mt-4">
            {{-- Con el metodo links() se hace una paginación y el posts trae todos los posts pero de 8 en 8
                como se definió en el PostController con el metodo paginate(8) --}}
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>