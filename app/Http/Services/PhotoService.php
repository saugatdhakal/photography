<?php

namespace App\Http\Services;

use App\Http\Actions\PhotoAction;
use App\Http\Requests\Photo\PhotoCreateRequest;
use App\Models\Photo;
use Exception;

class PhotoService extends PhotoAction
{
    /**
     * Store Photo Details DB and Image in Storage.
     * @param Request $request
     * @param Photo $photo
     * @return Photo $photo
     */
    function storePhoto(PhotoCreateRequest $requested, Photo $photo)
    {
        $photo_path = $this->savePhotoInStorage($requested->photo);
        if (!$photo_path) {
            throw new Exception("Can't store Photo In Storage", 500);
        }
        $photo = $this->storePhotoDetails($requested, $photo, $photo_path);
        return $photo;
    }
}
