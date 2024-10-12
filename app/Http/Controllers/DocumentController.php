<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.documents.index', [
            'documents' => Documentation::orderBy('id', 'DESC')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title_ka' => 'required|string',
            'title_en' => 'nullable|string',
            'file_ka' => 'required',
            'file_en' => 'nullable',
            'category' => 'required|string'
        ]);

        $file = null;
        $title = null;
         if ($request->hasFile('file_ka')) {
            $file_ka = $request->file('file_ka');
            $file_ka_name = uniqid() . '-' . time() .'.'. $file_ka->getClientOriginalExtension();
            $uploadPath = 'docs/documentations/' . $data['category'] ;

            $file_ka->move(public_path($uploadPath), $file_ka_name);
            $file = ["ka" => $file_ka_name, "en" => null];
        }
        if ($request->hasFile('file_en')) {
            $file_en = $request->file('file_en');
            $file_en_name = uniqid() . '-' . time() .'.'. $file_en->getClientOriginalExtension();
            $uploadPath = 'docs/documentations/' . $data['category'] ;

            $file_en->move(public_path($uploadPath), $file_en_name);
            $file = [...$file, "en" => $file_en_name ];
        }
        if($request-> title_ka) $title = ["ka" => $data['title_ka'], "en" => null];
        if($request-> title_en) $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];

        Documentation::create([
            'title' => $title,
            'file' => $file,
            'category' => $data['category']
        ]);

        return redirect()->route('documents.index', ['language' => app() -> getLocale()])->with('success', 'დოკუმენტი წარმატებით დაემატა');
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
    public function destroy(string $language, Documentation $document)
    {
        $document -> delete();
        return redirect() -> route('documents.index', ['language' => app() -> getLocale()]) -> with('success', 'დოკუმენტი წარმატებით წაიშალა.');
    }
}
