<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouncilRequest;
use App\Http\Requests\UpdateCouncilRequest;
use App\Models\Article;
use App\Models\Council;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouncilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.councils.index',[
            'councils' => Council::orderBy('id', 'DESC')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.councils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouncilRequest $request)
    {
        $data = $request->validated();
        $first_name = ["ka" => $data['first_name_ka'], "en" => $data['first_name_en']];
        $last_name = ["ka" => $data['last_name_ka'], "en" => $data['last_name_en']];
        $representative = ["ka" => $data['representative_ka'], "en" => $data['representative_en']];

        Council::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'representative' => $representative
        ]);
        return redirect()->route('councils.index', ['language' => app() -> getLocale()])->with('success', 'council added');
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
    public function edit(string $language, Council $council)
    {
        return view('admin.councils.edit', [
            'council' => $council
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouncilRequest $request,string $language,  Council $council)
    {
        $data = $request->validated();

        $first_name = ["ka" => $data['first_name_ka'], "en" => $data['first_name_en']];
        $last_name = ["ka" => $data['last_name_ka'], "en" => $data['last_name_en']];
        $representative = ["ka" => $data['representative_ka'], "en" => $data['representative_en']];

        $council -> update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'representative' => $representative
        ]);
        return redirect()-> back() -> with('success', 'საბჭოს წევრი წარმატებით განახლდა');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Council $council)
    {
        $council -> delete();
        return redirect() -> route('councils.index', ['language' => app() -> getLocale()]) -> with('success', 'საბჭოს წევრი წარმატებით წაიშალა.');
    }
}
