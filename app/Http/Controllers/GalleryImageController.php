<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'image' => 'required',
            'gallery_id' => 'required|string',
            'uuid' => 'required|string',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/galleries/' .$data['uuid'];
            $image->move(public_path($uploadPath), $imageName);
            GalleryImage::create([
                'image' => $imageName,
                'photo_gallery_id' => $data['gallery_id']
            ]);
            return redirect() -> back()-> with('success', 'სურათი წარმატებით აიტვირთა.');
        }
        return redirect() -> back()-> with('error', 'სურათი აიტვირთა ვერ მოხერხდა.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, GalleryImage $image)
    {
        $image -> delete();
        return redirect() -> back()-> with('success', 'სურათი წარმატებით წაიშალა.');
    }
}
