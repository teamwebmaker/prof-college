<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use Illuminate\Http\Request;

class DocContoller extends Controller
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
        $data = $request->validate([
            'title_ka' => 'required',
            'title_en' => 'required',
            'src' => 'required',
            'article_id' => 'required'
        ]);

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $storeData = [
          'title' => $title,
          'article_id' => $data['article_id']
        ];
        if ($request->hasFile('src')) {
            $file = $request->file('src');
            $type = $file->getClientOriginalExtension();
            $fileName = uniqid() . '-' . time() .'.'. $file->getClientOriginalExtension();
            $uploadPath = 'docs/articles' . $request -> uuid;
            $file->move(public_path($uploadPath), $fileName);
            $storeData = [...$storeData, 'type' => $type, 'src' => $fileName];
            Doc::create($storeData);
            return redirect() -> back() -> with('success', 'დოკუმენტი წარმატებით დაემატა');
        }
        return redirect() -> back() -> with('error', 'დოკუმენტის ატვირთვა ვერ მოხერხდა');

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
    public function destroy(string $id)
    {
        //
    }
}
