<?php

namespace App\Http\Controllers;

use App\Models\Graduated;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.graduates.index', [
            'graduates' => Graduated::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.graduates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title' => 'required|string',
            'description' => 'nullable',
            'image' => 'nullable|file',
            'poster' => 'nullable|file'
        ]);
        $storeData = [];
        if($request -> title) $storeData = [...$storeData, 'title' => $data['title']];
        if($request -> description) $storeData = [...$storeData, 'description' => $data['description']];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/graduates';
            $image->move(public_path($uploadPath), $imageName);
            if($uploadPath){
                $storeData = [...$storeData, 'image' => $imageName];
                Graduated::create($storeData);
                return redirect() -> route('graduates.index', ['language' => app() -> getLocale()]) -> with('success', 'კურსდამტავრებული წარმატებით დაემატა');
            }

        }

        if ($request->hasFile('poster')) {
            $poster= $request->file('poster');
            $posterName = uniqid() . '-' . time() .'.'. $poster->getClientOriginalExtension();
            $uploadPath = 'images/graduates';
            $poster->move(public_path($uploadPath), $posterName);
            if($uploadPath){
                $storeData = [...$storeData, 'poster' => $posterName];
                Graduated::create($storeData);
                return redirect() -> route('graduates.index', ['language' => app() -> getLocale()]) -> with('success', 'კურსდამტავრებული წარმატებით დაემატა');
            }
        }
        return redirect() -> back() -> with('error', 'კურსდამტავრებული დაემატა ვერ მოხერხდა');
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
    public function edit(string $language, Graduated $graduate)
    {
        return view('admin.graduates.edit',[
            'graduate' => $graduate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $language, Graduated $graduate)
    {
        $data = $request -> validate([
            'title' => 'required|string',
            'description' => 'nullable',
            'image' => 'nullable|file',
            'poster' => 'nullable|file'
        ]);

        $storeData = [];
        if($request -> title) $storeData = [...$storeData, 'title' => $data['title']];
        if($request -> description) $storeData = [...$storeData, 'description' => $data['description']];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/graduates';
            $image->move(public_path($uploadPath), $imageName);
            if($uploadPath){
                $storeData = [...$storeData, 'image' => $imageName];
                $graduate -> update($storeData);
                return redirect() -> back() -> with('success', 'კურსდამთავრებული წარმატებით განახლდა');
            }

        }

        if ($request->hasFile('poster')) {
            $poster= $request->file('poster');
            $posterName = uniqid() . '-' . time() .'.'. $poster->getClientOriginalExtension();
            $uploadPath = 'images/graduates';
            $poster->move(public_path($uploadPath), $posterName);
            if($uploadPath){
                $storeData = [...$storeData, 'poster' => $posterName];
               $graduate -> update($storeData);
               return redirect() -> back() -> with('success', 'კურსდამთავრებული წარმატებით განახლდა');
            }
        }
        $graduate -> update($storeData);
        return redirect() -> back() -> with('success', 'კურსდამთავრებული წარმატებით განახლდა');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Graduated $graduate)
    {
        $graduate -> delete();
        return redirect() -> route('graduates.index',['language' => app() -> getLocale()]) -> with('success', 'კურსდამთავრებული წარმატებით წაიშალა.');
    }
}
