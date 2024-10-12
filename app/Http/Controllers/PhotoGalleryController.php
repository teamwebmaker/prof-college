<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.photoGalleries.index', [
            'galleries' =>  PhotoGallery::orderBy('id', 'DESC')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photoGalleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title_ka' => 'required|string',
            'title_en'  => 'required|string',
        ]);
        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        PhotoGallery::create([
            'title' => $title,
            'uuid' =>  Str::uuid()->toString()
        ]);
        return redirect()->route('galleries.index',['language' => app() -> getLocale()])->with('success', 'ფოტო გალერია წარმატებით დაემატა');
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
    public function edit(string $language, PhotoGallery $gallery)
    {
        return view('admin.photoGalleries.edit', [
            'gallery' => $gallery -> load('gallery_images')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $language, PhotoGallery $gallery)
    {
        $data = $request -> validate([
            'title_ka' => 'required|string',
            'title_en'  => 'required|string',
        ]);
        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $gallery -> update([
            'title' => $title,
        ]);
        return redirect()->back()->with('success', 'ფოტო გალერია წარმატებით განახლდა');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, PhotoGallery $gallery)
    {
        $gallery -> delete();
        return redirect() -> route('galleries.index',['language' => app() -> getLocale()]) -> with('success', 'ფოტო გალერია წარმატებით წაიშალა.');
    }
}
