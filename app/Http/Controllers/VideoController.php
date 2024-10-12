<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.videos.index',[
            'videos' =>  Video::orderBy('id', 'DESC')->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title_ka' => 'required|string',
            'title_en' => 'required|string',
            'url' => 'required|string',
        ]);

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        Video::create([
            'title' => $title,
            'url' => $data['url']
        ]);
        return redirect() -> route('videos.index',['language' => app() -> getLocale()]) -> with('success', 'ვიდეო წარმატებით დამატა');
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
    public function edit(string $language, Video $video)
    {
        return view('admin.videos.edit',[
            'video' => $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $language, Video $video)
    {
        $data = $request -> validate([
            'title_ka' => 'required|string',
            'title_en' => 'required|string',
            'url' => 'required|string',
        ]);

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $video -> update([
            'title' => $title,
            'url' => $data['url']
        ]);
        return redirect() -> back() -> with('success', 'ვიდეო წარმატებით განახლდა');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Video $video)
    {
        $video -> delete();
        return redirect() -> route('videos.index',['language' => app() -> getLocale()]) -> with('success', 'ვიდეო წარმატებით წაიშალა.');
    }
}
