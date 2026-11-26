@extends("app")

@section("content")

<div id="index">
    <div>
        <form method="get" id="formsearch" action="#">
            <i class="fas fa-search"></i>
            <input type="search" name="searchtd" placeholder="Titre ou date de création" value="{{ $search }}" id="searchtd">
        </form>
    </div>
    
    <div id="albums">
    @foreach($albums as $album)
        <div class="album">
            <div class="carte-image">
                <a href="{{ route('album', ['id' => $album->id]) }}" class="carte">
                    @if($photos[$album->id])
                        <img src="{{ $photos[$album->id]->url }}" alt="{{ $photos[$album->id]->titre }}">
                    @else
                        <div class="carte-vide"><i class="fas fa-image"></i></div>
                    @endif 
                </a>
            </div>

            <div class="carte-infos">
                <h2>{{ $album->titre }}</h2>
                <p class="carte-user"><i class="fas fa-user"></i> {{ $album->name ?? 'Aucun propriétaire' }}</p> 
                <span class="carte-date"><i class="fas fa-calendar"></i> {{ $album->creation }}</span>
            </div>
        </div>
    @endforeach
    </div>
</div>

@endsection
