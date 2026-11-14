@extends("app")

@section("content")

<div id="index">
 <form method="get">
    <input type="search" name="searchtd" placeholder="titre ou date de création annee-mois-date" value="{{ $search }}" id="searchtd">
 </form>
    @foreach($albums as $album)

        <a href="{{ route("album", ["id"=>$album->id]) }}">{{ $album->titre }}</a>
        <p>{{ $album->creation }}</p>
    @endforeach
</div>

@endsection
