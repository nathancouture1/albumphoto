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

public function album($id, Request $request){
    $search = $request->input("search");
    $tagActif = $request->input('tag');
    $noteActive = $request->input("note");

    if (isset($tagActif) == true && isset($noteActive) == true) {
        $photos = DB::select("SELECT photos.* FROM photos
                            JOIN possede_tag ON possede_tag.photo_id = photos.id
                            WHERE photos.album_id = ? AND possede_tag.tag_id = ? AND photos.note = ?",
                            [$id, $tagActif, $noteActive]);
    }
    elseif (isset($tagActif) == true) {
        $photos = DB::select("SELECT photos.* FROM photos
                            JOIN possede_tag ON possede_tag.photo_id = photos.id
                            WHERE photos.album_id = ? AND possede_tag.tag_id = ?",
                            [$id, $tagActif]);
    }
    elseif (isset($noteActive) == true) {
        $photos = DB::select("SELECT * FROM photos WHERE album_id = ? AND note = ?",
                            [$id, $noteActive]);
    }
    else {
        $photos = DB::select("SELECT * FROM photos WHERE album_id = ?", [$id]);
    }

    if ($search != null)
        $photos = DB::select("SELECT * FROM photos WHERE titre LIKE ? AND album_id = ?",
                            ["%".$search."%", $id]);

    $tags = DB::select("SELECT DISTINCT tags.id, tags.nom FROM tags 
                        JOIN possede_tag ON possede_tag.tag_id = tags.id 
                        JOIN photos ON photos.id = possede_tag.photo_id 
                        WHERE photos.album_id = ?", [$id]);

    $tagsdesphotos = DB::select("SELECT tags.id, tags.nom, possede_tag.photo_id FROM tags
                                JOIN possede_tag ON possede_tag.tag_id = tags.id
                                JOIN photos ON photos.id = possede_tag.photo_id
                                WHERE photos.album_id = ?", [$id]);
    $tagsparphoto = [];
    foreach ($tagsdesphotos as $tagphoto){
        $tagsparphoto[$tagphoto->photo_id][] = $tagphoto;
    }
    return view("album", compact("id", "photos", "tags", "tagsparphoto", "tagsdesphotos", "search", "tagActif", "noteActive"));
}

}
