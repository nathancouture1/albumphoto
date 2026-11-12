@extends('app')
@section('content')

<div id="album">
    <form method="get">
        <input type="search" name="search" placeholder="titre" value="{{ $search }}">

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

    <form method="POST" action="{{ route("ajouterphoto", ["id" => $id]) }}">
        @csrf
        <input type="text" placeholder="titre de la photo" name="titrephoto" value="{{ old('titrephoto') }}">
        <input type="text" placeholder="lien de la photo" name="urlphoto" value="{{ old('urlphoto') }}">
        <input type="number" placeholder="note de la photo" name="note" value="{{ old('note') }}">
        <input type="submit" value="Envoyer la photo">
    </form>

    <form method="POST" action="{{ route("uploadphoto", ["id" => $id])}}" enctype="multipart/form-data" id="uploadphoto">
        @csrf
        <input type="text" placeholder="titre de la photo" name="titrephoto" value="{{ old('titrephoto') }}">
        <input type="file" name="ajoutphoto" id="photo" accept="image/*">
        <input type="number" placeholder="note de la photo (1 à 5)" name="note" value="{{ old('note') }}">  
        <input type="submit" value="Ajouter la photo">
    </form>

    <div class="filtres">
        <a href="{{ route("album", ["id" => $id]) }}"> TOUS</a>
    </div>

    @foreach ($tags as $tag)
        <a href="{{ route("album", ["id"=> $id, "tag" => $tag->id, "note" => $noteActive]) }}"> {{$tag->nom}}</a>
    @endforeach

    @foreach ($photos as $photo)
    <div class="photo">
        <img src="{{ $photo->url }}" alt="photo de {{ $photo->titre }}" class="image">

        <div class="tags">
            @foreach ($tagsparphoto[$photo->id] ?? [] as $tagphoto)
                <span class="tag"> #{{ $tagphoto->nom }}</span>
            @endforeach
        </div>
    </div>
    @endforeach
</div>

<div id="backlight">
        <img id="backlight-img" src="" alt="">
</div>

@endsection