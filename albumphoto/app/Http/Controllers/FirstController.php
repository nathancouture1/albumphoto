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
    $tagActif = $request->input("tag");
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

public function formulaireurl($id){
    return view("formulaireurl", compact("id"));
}

public function formulaireupload($id){
    return view("formulaireupload", compact("id"));
}
public function ajouterphoto($id, Request $request){
        $request->validate(["titrephoto" => "required|string", "urlphoto" => "required|string", "note" => "required|integer|min:1|max:5"]);
        
        DB::insert("INSERT INTO photos(titre, url, note, album_id) VALUES(?, ?, ?, ?)", [$request->input("titrephoto"), $request->input("urlphoto"), $request->input("note"), $id]);
        
         $photoId = DB::getPdo()->lastInsertId();
        $tags = $request->input('tags');
   
         if (isset($tags) == true && $tags != ""){
            $tagExistant = DB::selectOne("SELECT id FROM tags WHERE nom = ?", [$tags]);

        if ($tagExistant != null) {
            $tagId = $tagExistant->id;
        }
        else {
       
        DB::insert('INSERT INTO tags (nom) VALUES (?)', [$tags]);
        
        $tagId = DB::getPdo()->lastInsertId(); 
        }
        
        DB::insert("INSERT INTO possede_tag(photo_id, tag_id)  VALUES (?, ?)", [$photoId, $tagId]);
    } 
        return redirect(route("album", ["id" => $id]));
    }

public function uploadphoto($id, Request $request){
    $request->validate(["titrephoto" => "required|string", "note" => "required|integer|min:1|max:5", "ajoutphoto" => "required|image"]);
    $fichier = $request->file('ajoutphoto');
    $nom = $request->input('titrephoto') . '.' . $fichier->extension();
    $fichier->move(public_path('photos'), $nom);
    
    DB::insert("INSERT INTO photos(titre, url, note, album_id) VALUES (?, ? , ?, ?)", [$request->input('titrephoto'), '/photos/' . $nom, $request->input('note'), $id]);
    
    $photoId = DB::getPdo()->lastInsertId();
    $tags = $request->input('tags');
   
    if (isset($tags) == true && $tags != ""){
        $tagExistant = DB::selectOne("SELECT id FROM tags WHERE nom = ?", [$tags]);

        if ($tagExistant != null) {
            $tagId = $tagExistant->id;
        }
        else {
       
        DB::insert('INSERT INTO tags (nom) VALUES (?)', [$tags]);
        
        $tagId = DB::getPdo()->lastInsertId(); 
        }
        
        DB::insert("INSERT INTO possede_tag(photo_id, tag_id)  VALUES (?, ?)", [$photoId, $tagId]);
    } 
    return redirect(route("album", ["id" => $id]));
}
public function supprimerphoto($id){
    $photo = DB::selectOne("SELECT album_id, url FROM photos WHERE id = ?", [$id]);
    
    if ($photo == null) {
        return redirect(route("index"));
    }
    
    DB::delete("DELETE FROM possede_tag WHERE photo_id = ?", [$id]);
   
    DB::delete("DELETE FROM photos WHERE id = ?", [$id]);
    
    $chemin = public_path($photo->url);
        
    if (file_exists($chemin)) {
            @unlink($chemin);
        }
    return redirect(route("album", ['id' => $photo->album_id]));
}
}


