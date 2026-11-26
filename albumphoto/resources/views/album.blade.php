@extends('app')
@section('content')

<div id="album">
    <a href="{{ route('index') }}" id="retour"><i class="fa-solid fa-arrow-left"></i></a> 
    <div id="search">
        <form method="get" action="#" id="formsearch">
            <i class="fas fa-search"></i>    
            <input type="search" name="searchtitre" placeholder="Titre" value="{{ $search }}">
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
            <a href="{{ route('formulaireurl', ['id' => $id]) }}" id="blue"><i class="fas fa-link"></i>Ajouter une image avec url</a>
            <a href="{{ route('formulaireupload', ['id' => $id]) }}" id="green"><i class="fas fa-upload"></i>Ajouter une image stockée localement</a>
        @endauth 
    </div>
  
    
    <div id="filtres">
        <a href="{{ route("album", ["id" => $id]) }}" class="{{ $tagActif ? '' : 'actif' }}"> TOUS</a>
        @foreach ($tags as $tag)
            <a href="{{ route("album", ["id"=> $id, "tag" => $tag->id, "note" => $noteActive]) }}" class="{{ $tagActif == $tag->id ? 'actif' : '' }}" > #{{$tag->nom}}</a>
        @endforeach
    </div>
    
    <div id="photos">
    @foreach ($photos as $photo)
        <div class="photo">
            <div class="div-image">
                <img src="{{ $photo->url }}" alt="photo de {{ $photo->titre }}" class="image">
            </div>
            <div class="photo-infos">
                <h3>{{ $photo->titre }}</h3>
                <div class="tags">
                    @foreach ($tagsparphoto[$photo->id] ?? [] as $tagphoto)
                        <span> #{{ $tagphoto->nom }}</span>
                    @endforeach
                </div>
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
</div>

    

@endsection