<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vacancies.index', [
            'vacancies' => Vacancy::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'file'=> 'required'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '-' . time() .'.'. $file->getClientOriginalExtension();
            $uploadPath = 'docs/vacancies';

            $file->move(public_path($uploadPath), $fileName);
            if($uploadPath){
                $storeData = [
                    'title' => $data['title'],
                    'file' => $fileName
                ];
                Vacancy::create($storeData);
            }
        } else  return redirect()->route('vacancies.index', ['language' => app() -> getLocale()])->with('error', 'ვაკანიის დამატება ვერ მოხერხდა');
        return redirect()->route('vacancies.index', ['language' => app() -> getLocale()])->with('success', 'ვაკანსია წარმატებით დამეტა');
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
    public function destroy(string $language, Vacancy $vacancy)
    {
        $vacancy -> delete();
        return redirect() -> route('vacancies.index',['language' => app() -> getLocale()]) -> with('success', 'ვაკანსია წარმატებით წაიშალა.');
    }
}
