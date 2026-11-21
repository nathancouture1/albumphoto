@extends("app")

@section("content")

<div id="index">
 <form method="get">
    <input type="search" name="searchtd" placeholder="titre ou date de création annee-mois-date" value="{{ $search }}" id="searchtd">
 </form>
    @foreach($albums as $album)

        <a href="{{ route('album', ['id' => $album->id]) }}">{{ $album->titre }}
        
            @isset($photos[$album->id])
                <img src="{{ $photos[$album->id]->url }}" alt="{{ $photos[$album->id]->titre }}">
            @else
                <span>Aucune photo</span>
            @endisset
</a>
        <p>{{ $album->creation }}</p>
        
        <p>{{$album->name}}</p>
 
    @endforeach
</div>

@endsection
