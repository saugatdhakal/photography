<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\PhotoCreateRequest;
use App\Http\Services\PhotoService;
use App\Models\Photo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    private PhotoService $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function allPhotos()
    {
        $photos = Photo::select('id', 'image_path', 'title')->paginate(20);
        return $photos;
    }
    public function getPhoto($id)
    {
        if (!$id) {
            return response()->json(array('error' => 'Failed to retrieve id'));
        }
        return Photo::with(['album' => function ($q) {
            $q->select('name', 'id');
        }])->find($id);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoCreateRequest $requested)
    {
        DB::beginTransaction();
        try {
            $photo = new Photo();
            $photoDetails = $this->photoService->storePhoto($requested, $photo);
            if (!$photoDetails) {
                DB::rollBack();
                return response()->json([
                    'status' => False,
                    'Message' => "Can't store photo",
                    'data' => $photoDetails
                ], 500);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Image Uploaded Successfully',
                'user' => $photo,
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            return response([
                'status' => false,
                'message' => "{$e->getMessage()}",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
