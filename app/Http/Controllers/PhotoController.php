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

        if ($request->input('filters')) {


            $filters = explode(',', $request->input('filters'));

            $photos = Photo::whereHas('tags', function ($q) use ($filters) {
                $q->whereIn('id', $filters);
            })->get();

        } else {
            $photos = Photo::all();
        }

        return PhotoResource::collection($photos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tags = explode(',', $request->input('tags'));

        $path = $request->file('photo')->store('', 's3');
        $photo = new Photo();
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->slug = \Str::slug($request->input('title'));
        $photo->img_path = $path;
        $photo->save();


        $photo->tags()->attach($tags);




        return response($photo);
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
