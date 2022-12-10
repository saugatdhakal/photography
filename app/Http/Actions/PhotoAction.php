<?php

namespace App\Http\Actions;

use App\Http\Requests\Photo\PhotoCreateRequest;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

class PhotoAction
{
    /**
     * Store Photo Details in Database.
     * @param  PhotoCreateRequest  $request
     * @param Photo $photo
     * @param string $photo_path
     * @return Photo $obj
     */
    public function storePhotoDetails(PhotoCreateRequest $request, Photo $photo, string $photo_path): Photo
    {
        $photo->title = $request->title;
        $photo->image_path = $photo_path;
        $photo->price = $request->price;
        $photo->capture_date = $request->capture_date;
        $photo->album_id = $request->album_id;
        $photo->description = $request->description;
        $photo->save();
        return $photo;
    }
    /**
     * Store Photo Details in Database.
     * @param $photo
     * @return string $path_photo
     */
    public function savePhotoInStorage($photo): string
    {
        $image = Image::make($photo, 60)->resize(
            1000,
            null,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        );
        $fileName = time() . '.' . $photo->extension();
        $image->save(storage_path('app/public/images/' . $fileName), 80);
        return $fileName;
    }
}
