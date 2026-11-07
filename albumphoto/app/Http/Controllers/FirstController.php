<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirstController extends Controller
{
    public function index(){
    $albums = DB::select("SELECT * FROM albums");
    return view("index", compact("albums"));
}

    public function album($id){
        $photos = DB::select("SELECT * FROM photos WHERE album_id = ?", [$id]);
        $tags = DB::select("SELECT tags.id, tags.nom, possede_tag.photo_id FROM tags JOIN possede_tag ON possede_tag.tag_id = tags.id JOIN photos ON photos.id = possede_tag.photo_id WHERE  photos.album_id = ?", [$id]);
        $tagsparphoto = [];
        foreach ($tags as $tag){
            $tagsparphoto[$tag->photo_id][] = $tag;
        }
        return view("album", compact("photos", "tags", "tagsparphoto"));
    }
}
