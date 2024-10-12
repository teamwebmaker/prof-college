<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.programs.index', [
            'programs' =>  Program::orderBy('id', 'DESC')->paginate(8),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ka' => 'required',
            'title_en' => 'required',
            'file_ka' => 'required|file',
            'file_en' => 'required|file',
            'category' => 'required'
        ]);

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $file = [];

        if ($request->hasFile('file_ka')) {
            $file_ka = $request->file('file_ka');
            $file_name_ka = uniqid() . '-' . time() . '.' . $file_ka->getClientOriginalExtension();
            $uploadPath = 'docs/programs/' . $data['category'];
            $file_ka->move(public_path($uploadPath), $file_name_ka);
            $file['ka'] = $file_name_ka;
        }

        if ($request->hasFile('file_en')) {
            $file_en = $request->file('file_en');
            $file_name_en = uniqid() . '-' . time() . '.' . $file_en->getClientOriginalExtension();
            $uploadPath = 'docs/programs/' . $data['category'];
            $file_en->move(public_path($uploadPath), $file_name_en);
            $file['en'] = $file_name_en;
        }

        $programData = [
            'title' => $title,
            'category' => $data['category']
        ];

        if (!empty($file)) {
            $programData['file'] = $file;
        }

        $program = Program::create($programData);

        return redirect()->route('programs.index') -> with('success', 'პროგრამა წამატებით დაემატა');

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
    public function edit(string $language, Program $program)
    {
        return view('admin.programs.edit', [
            'program' => $program
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $language, Program $program)
    {
        $data = $request->validate([
            'title_ka' => 'required',
            'title_en' => 'required',
            'file_ka' => 'nullable|file',
            'file_en' => 'nullable|file',
            'category' => 'required'
        ]);

        $title = ["ka" => $data['title_ka'], "en" => $data['title_en']];
        $file = [];

        if ($request->hasFile('file_ka')) {
            $file_ka = $request->file('file_ka');
            $file_name_ka = uniqid() . '-' . time() . '.' . $file_ka->getClientOriginalExtension();
            $uploadPath = 'docs/programs/' . $data['category'];
            $file_ka->move(public_path($uploadPath), $file_name_ka);
            $file['ka'] = $file_name_ka;
        }

        if ($request->hasFile('file_en')) {
            $file_en = $request->file('file_en');
            $file_name_en = uniqid() . '-' . time() . '.' . $file_en->getClientOriginalExtension();
            $uploadPath = 'docs/programs/' . $data['category'];
            $file_en->move(public_path($uploadPath), $file_name_en);
            $file['en'] = $file_name_en;
        }

        $programData = [
            'title' => $title,
            'category' => $data['category']
        ];

        if (!empty($file)) {
            $programData['file'] = $file;
        }

        $program->update($programData);

        return redirect()->back()->with('success', 'პროგრამა წამატებით განახლა');

    }

    /**ს
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Program $program)
    {
        $program -> delete();
        return redirect() -> route('programs.index',['language' => app() -> getLocale()]) -> with('success', 'პროგრამა წარმატებით წაიშალა.');
    }
}
