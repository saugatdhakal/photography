<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillables=[
        'titile',
        'description',
        'upload_date',
        'price',
        'image_path',
        'status',
        'album_id'
    ];

    public function getPhotoPath($photo)
    {
        $fileName = time() . '.' . $photo->extension();
        $photo->storeAs('public/images', $fileName);
        return "/storage/images/" . $fileName;
    }
}
