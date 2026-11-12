@extends('app')
@section('content')
    <a href="{{ route('album', ['id' => $id]) }}"><i class="fa-solid fa-arrow-left"></i></a>
    <form method="POST" action="{{ route("ajouterphoto", ["id" => $id]) }}">
        @csrf
        <input type="text" placeholder="titre de la photo" name="titrephoto" value="{{ old('titrephoto') }}">
        <input type="text" placeholder="lien de la photo" name="urlphoto" value="{{ old('urlphoto') }}">
        <input type="number" placeholder="note de la photo" name="note" value="{{ old('note') }}">
        <input type="text" placeholder="tags" name="tags" id="tags">
        <input type="submit" value="Envoyer la photo">
    </form>
@endsection