<div class="form-group">
    <label for="name">Nombre: </label>
    <input class="form-control" name="name" id="name" @if ($issetPost) value="{{$post->name}}" @endif type="text" placeholder="Ingrese el nombre del post">
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <input class="form-control" name="slug" id="slug" readonly @if ($issetPost) value="{{$post->slug}}" @endif type="hidden">
    @error('slug')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="body">Categoria: </label>
    <select class="form-control" name="category_id" id="category_id">
        @if ($issetPost) 
            <option value="{{$post->category_id}}">{{$post->category->name}}</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        @else
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        @endif

    </select>
    @error('category_id')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Etiquetas:</p>
    <div class="form-check">
        @foreach ($tags as $tag)   
        {{-- El checkbox deja que uno pueda escoger varios, cada nombre e id es único, por eso
            se le manda en el name el tags[] y en el id tags{{$tags->id}} para que acceda al id del tag --}}
        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" name="tags[]" id="tags{{$tag->id}}">
        <label class="form-check-label mr-4">
            {{$tag->name}}
        </label> 
        @endforeach
    </div>
    @error('tags')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Estado:</p>
    <div class="form-check">
        {{-- El radio deja que se pueda escoger solo uno de las opciones --}}
        @if ($issetPost)
            @if ($post->status == 2)
                <input class="form-check-input" type="radio" value="1" name="status" id="status">
                <label class="form-check-label mr-4" for="flexRadioDefault1">
                    Borrador
                </label>
                <input class="form-check-input" type="radio" value="2" checked name="status" id="status">
                <label class="form-check-label mr-4" for="flexRadioDefault1">
                    Publicado
                </label>
            @endif
        @else
            <input class="form-check-input" type="radio" value="1" checked name="status" id="status">
            <label class="form-check-label mr-4" for="flexRadioDefault1">
                Borrador
            </label>
            <input class="form-check-input" type="radio" value="2" name="status" id="status">
            <label class="form-check-label mr-4" for="flexRadioDefault1">
                Publicado
            </label>
        @endif
    </div>
    @error('status')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

{{-- imagen --}}
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @if ($issetPost) 
                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2023/08/18/15/02/cat-8198720_1280.jpg" alt="ImagenGato">
            @endif

        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="file">Imagen que se mostrará en el post:</label>
            <input class="form-control-file" type="file" name="file" id="file">
        </div>
            @error('file')
                <span class="text-danger">{{$message}}</span>
            @enderror
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae deserunt fuga asperiores aspernatur ullam nulla mollitia dolore, voluptatem ducimus exercitationem necessitatibus id porro temporibus accusantium voluptatum quia aliquam accusamus neque?</p>
    </div>
</div>

<div class="form-group">
    <label for="extract">Extracto: </label>
    <textarea class="form-control" name="extract" id="extract" rows="5">@if ($issetPost) {{$post->extract}} @endif</textarea>
    @error('extract')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="body">Cuerpo del post: </label>
    <textarea class="form-control" name="body" id="body" rows="5">@if ($issetPost) {{$post->body}} @endif</textarea>
    @error('body')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>