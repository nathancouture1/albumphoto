@extends("app")

@section("content")

<div id="index">
    <div>
        <form method="get" id="search">
            <input type="search" name="searchtd" placeholder="titre ou date de création annee-mois-date" value="{{ $search }}" id="searchtd">
        </form>
    </div>
    
    <div id="albums">
    @foreach($albums as $album)
        <div class="album">
            <a href="{{ route('album', ['id' => $album->id]) }}">
                @isset($photos[$album->id])
                    <img src="{{ $photos[$album->id]->url }}" alt="{{ $photos[$album->id]->titre }}">
                @else
                    <span>Aucune photo</span>
                @endisset   
            </a>
            <h3>{{ $album->titre }}</h3>

            <p>{{ $album->creation }}</p>

            <p>{{$album->name}}</p>
        </div>
    @endforeach
    </div>
</div>

@endsection
