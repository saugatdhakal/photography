<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Services\AlbumService;
use App\Models\Album;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{

    private AlbumService $albumService;

    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return DB::table('albums')->get(['id', 'name']);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(AlbumRequest $request)
    {
        try {
            $album = new Album();
            $this->albumService->createUpdateAlbum($request,$album);
            if(!$album){
                return response()->json([
                    'status' => 'Error',
                    'message' =>'can not create a new album'
                ], 500);
            }
            return response()->json([
                'status' => 'success',
                'album' => $album,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
