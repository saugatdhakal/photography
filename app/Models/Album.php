<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function createUpdateAlbum($request)
    {
        $this->name = $request->album_name;
        $this->description = $request->description;
        $this->save();
    }
}
