@extends("app")

@section("content")

<div id="index">
    @foreach($albums as $album)

        <a href="{{ route("album", ["id"=>$album->id]) }}">{{ $album->titre }}</a>
    @endforeach
</div>

@endsection
