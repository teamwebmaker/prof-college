<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.professions.index', [
            'professions' => Profession::orderBy('id', 'DESC')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.professions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'title_ka' => 'nullable|string|min:3',
            'title_en' => 'nullable|string|min:3',
            'type_ka' => 'nullable|string|min:3',
            'type_en' => 'nullable|string|min:3',
            'condition_ka' => 'nullable|string|min:3',
            'condition_en' => 'nullable|string|min:3',
            'image' => 'nullable|file',
            'level' => 'nullable|string',
            'credits' => 'nullable',
            'custom_credits' => 'nullable',
            'duration' => 'nullable',
            'custom_duration' => 'nullable'
        ]);

        $storeData = [];
        if($request -> title_ka) {
            $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
            $storeData = [
                ...$storeData,
                'title' => $title
            ];
        }
        if($request -> type_ka) {
            $type = ["ka" => $data['type_ka'], "en" => $data['type_en']];
            $storeData = [
                ...$storeData,
                'type' => $type
            ];
        }
        if($request -> condition_ka) {
            $condition = ["ka" => $data['condition_ka'], "en" => $data['condition_en']];
            $storeData = [
                ...$storeData,
                'condition' => $condition
            ];
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/professions';
            $image->move(public_path($uploadPath), $imageName);
            $storeData = [
                ...$storeData,
                'image' => $imageName
            ];
        }
        if($request -> level) $storeData = [...$storeData, 'level' => $data['level']];
        if($request -> credits) $storeData = [...$storeData, 'credits' => $data['credits']];
        if($request -> custom_credits) $storeData = [...$storeData, 'custom_credits' => $data['custom_credits']];
        if($request -> duration) $storeData = [...$storeData, 'duration' => $data['duration']];
        if($request -> custom_duration) $storeData = [...$storeData, 'custom_duration' => $data['custom_duration']];

        Profession::create($storeData);

        return redirect() -> route('professions.index',['language' => app() -> getLocale()]) -> with('message', 'პროფესია დამატებულია წარმატებით');
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
    public function edit(string $language, Profession $profession)
    {
        return view('admin.professions.edit', [
            'profession' => $profession
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $language, Profession $profession)
    {
        $data = $request -> validate([
            'title_ka' => 'nullable|string|min:3',
            'title_en' => 'nullable|string|min:3',
            'type_ka' => 'nullable|string|min:3',
            'type_en' => 'nullable|string|min:3',
            'condition_ka' => 'nullable|string|min:3',
            'condition_en' => 'nullable|string|min:3',
            'image' => 'nullable|file',
            'level' => 'nullable|string',
            'credits' => 'nullable',
            'custom_credits' => 'nullable',
            'duration' => 'nullable',
            'custom_duration' => 'nullable'
        ]);

        $storeData = [];
        if($request -> title_ka) {
            $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
            $storeData = [
                ...$storeData,
                'title' => $title
            ];
        }
        if($request -> type_ka) {
            $type = ["ka" => $data['type_ka'], "en" => $data['type_en']];
            $storeData = [
                ...$storeData,
                'type' => $type
            ];
        }
        if($request -> condition_ka) {
            $condition = ["ka" => $data['condition_ka'], "en" => $data['condition_en']];
            $storeData = [
                ...$storeData,
                'condition' => $condition
            ];
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/professions';
            $image->move(public_path($uploadPath), $imageName);
            $storeData = [
                ...$storeData,
                'image' => $imageName
            ];
        }
        if($request -> level) $storeData = [...$storeData, 'level' => $data['level']];
        if($request -> credits) $storeData = [...$storeData, 'credits' => $data['credits']];
        if($request -> custom_credits) $storeData = [...$storeData, 'custom_credits' => $data['custom_credits']];
        if($request -> duration) $storeData = [...$storeData, 'duration' => $data['duration']];
        if($request -> custom_duration) $storeData = [...$storeData, 'custom_duration' => $data['custom_duration']];

        $profession -> update($storeData);

        return redirect() -> back() -> with('message', 'პროფესია განახლდა წარმატებით');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Profession $profession)
    {
        $profession -> delete();
        return redirect() -> route('professions.index',['language' => app() -> getLocale()]) -> with('success', 'პროფესია წარმატებით წაიშალა.');
    }
}
