@extends('app')
@section('content')

<div id="album">
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
        <input type="submit" value="rechercher">
    </form>

    <a href="{{ route('formulaireurl', ['id' => $id]) }}">Ajouter une image avec url</a>
    <a href="{{ route('formulaireupload', ['id' => $id]) }}">Ajouter une image stockée localement</a>

    <div class="filtres">
        <a href="{{ route("album", ["id" => $id]) }}"> TOUS</a>
    </div>

    @foreach ($tags as $tag)
        <a href="{{ route("album", ["id"=> $id, "tag" => $tag->id, "note" => $noteActive]) }}"> {{$tag->nom}}</a>
    @endforeach

    @foreach ($photos as $photo)
    <div class="photos">
        <img src="{{ $photo->url }}" alt="photo de {{ $photo->titre }}" class="image">

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