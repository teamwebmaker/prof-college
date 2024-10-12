<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.slides.index',
            [
                'slides' => Slide::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('slide')) {
            $image = $request->file('slide');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/slides';
            $image->move(public_path($uploadPath), $imageName);
            Slide::create([
                'slide' => $imageName
            ]);
            return redirect() -> route('slides.index',['language' => app() -> getLocale()]) -> with('success', 'სლაიდი წარმატებით დაემატა');
        }
        return redirect() -> back() -> with('success', 'სლაიდი ატვირთვა ვერ მოხერხდა');
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
    public function destroy(string $language, Slide $slide)
    {
        $slide -> delete();
        return redirect() -> route('slides.index',['language' => app() -> getLocale()]) -> with('success', 'სლაიდი წარმატებით წაიშალა.');
    }
}
