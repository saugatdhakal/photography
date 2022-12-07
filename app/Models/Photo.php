<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class Photo extends Model
{
    use HasFactory;

    protected $fillables = [
        'titile',
        'description',
        'upload_date',
        'price',
        'image_path',
        'status',
        'album_id'
    ];
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    // Accessor and Mutator if image path
    protected function imagePath(): Attribute
    {
        return new Attribute(
            get: fn ($value) => url($value),
            set: fn ($value) => '/storage/images/' . $value
        );
    }
    public static function getPhotoById($id)
    {
        if (!$id) {
            return response()->json(array('error' => 'Failed to retrieve id'));
        }
        return Photo::with(['album' => function ($q) {
            $q->select('name', 'id');
        }])->find($id);
    }
    // public function savePhotoInStorage($photo): string
    // {
    //     $image = Image::make($photo, 80)->resize(
    //         1200,
    //         1200,
    //         function ($constraint) {
    //             $constraint->aspectRatio();
    //         }
    //     );
    //     $fileName = time() . '.' . $photo->extension();
    //     $image->save(storage_path('app/public/images/' . $fileName), 10);
    //     return $fileName;
    // }
}
