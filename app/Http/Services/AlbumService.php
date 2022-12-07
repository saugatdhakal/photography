<?php
namespace App\Http\Services;

class AlbumService{

    public function createUpdateAlbum($request,$album):void
    {
        $album->name = $request->album_name;
        $album->description = $request->description;
        $album->save();
    }
}
