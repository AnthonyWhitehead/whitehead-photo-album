<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request->input('filters'));
//
//        dd(Photo::with(['tags' => function($q) use ($request) {
//            $q->whereIn('id', $request->input('filters'));
//        }])->get());

        return PhotoResource::collection();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $photos = [];

        foreach ($request->allFiles() as $key => $value){

            $path = $value->store('', 's3');

            $photo = new Photo();
            $photo->title = $key;
            $photo->slug = \Str::slug($key);
            $photo->img_path = $path;
            $photo->save();

            array_push($photos, $photo);
        }



        return response($photos);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PhotoResource|\Illuminate\Http\Response
     */
    public function show($id): PhotoResource|\Illuminate\Http\Response
    {

        return new PhotoResource(Photo::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
