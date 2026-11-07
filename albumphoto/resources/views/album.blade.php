@extends('app')
@section('content')

<div id="album">

    @foreach ($photos as $photo)
    <div class="photo">
        <img src="{{ $photo->url }}" alt="photo de {{ $photo->titre }}"" class="image" onclick="ouvrir(this)">

        <div class="tags">
            @foreach ($tagsparphoto[$photo->id] ?? [] as $tag)
                <span class="tag"> #{{ $tag->nom }}</span>
            @endforeach
        </div>
    </div>
    @endforeach


    <div id="backlight">
        <img id="backlight-img" src="" alt="">
    </div>







</div>

@endsection