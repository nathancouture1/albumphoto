@extends('app')
@section('content')
   <a href="{{ route('album', ['id' => $id]) }}"><i class="fa-solid fa-arrow-left"></i></a>
   <form method="POST" action="{{ route("uploadphoto", ["id" => $id])}}" enctype="multipart/form-data" id="uploadphoto">
        @csrf
        <input type="text" placeholder="titre de la photo" name="titrephoto" value="{{ old('titrephoto') }}">
        <label for="photo" id="boutonupload">
            Choisir une photo
            <input type="file" name="ajoutphoto" id="photo" accept="image/*">
        </label>
        <input type="number" placeholder="note de la photo (1 à 5)" name="note" value="{{ old('note') }}"> 
        <input type="text" placeholder="tags séparés par une virgule" name="tags" id="tags"> 
        <input type="submit" value="Ajouter la photo">
    </form>

@endsection