@extends('app')
@section('content')

<div id="album">
    <a href="{{ route('index') }}"><i class="fa-solid fa-arrow-left"></i></a> 
    <div id="searchn">
        <form method="get">    
            <input type="search" name="searchtitre" placeholder="titre" value="{{ $search }}">
            <select name="note">
                <option value="">Toutes les notes</option>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($noteActive == $i)
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
            <input type="submit" value="Rechercher">
        </form>
    </div>

    <div id="links">
         @auth
            <a href="{{ route('formulaireurl', ['id' => $id]) }}">Ajouter une image avec url</a>
            <a href="{{ route('formulaireupload', ['id' => $id]) }}">Ajouter une image stockée localement</a>
        @endauth 
    </div>
  
    
    <div id="filtres">
        <a href="{{ route("album", ["id" => $id]) }}"> TOUS</a>
        @foreach ($tags as $tag)
            <a href="{{ route("album", ["id"=> $id, "tag" => $tag->id, "note" => $noteActive]) }}"> {{$tag->nom}}</a>
        @endforeach
    </div>

    @foreach ($photos as $photo)
    <div class="photos">
        <img src="{{ $photo->url }}" alt="photo de {{ $photo->titre }}" class="image">
        <h3>{{ $photo->titre }}</h3>
        <div class="tags">
            @foreach ($tagsparphoto[$photo->id] ?? [] as $tagphoto)
                <span class="tag"> #{{ $tagphoto->nom }}</span>
            @endforeach
        </div>
        <form method="POST" action="{{ route('supprimerphoto', ['id' => $photo->id]) }}">
            @csrf
            <button type="submit" id="suppresion">SUPPRIMER</button>
        </form>
        
    </div>
    @endforeach
</div>

<div id="backlight">
        <img id="backlight-img" src="" alt="">
</div>

@endsection