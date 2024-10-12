<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.visitors.index',[
            'visitors' => Visitor::all()
        ]);
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
            'region' => 'nullable|string|min:3',
            'district' => 'nullable|string|min:3',
            'school' => 'required|string|min:3',
            'date' => 'required|date',
            'phone' => 'required|min:9|max:11'
        ]);
        $storeData = [
            'school' => $data['school'],
            'date' => $data['date'],
            'phone' => $data['phone']
        ];
        if ($data['region'])  $storeData = [...$storeData, 'region' => $data['region']];
        if ($data['district'])  $storeData = [...$storeData, 'district' => $data['district']];
        Visitor::create($storeData);
        return redirect() -> back() -> with('success', 'საკონტაქტო ინფორმაცია წარმატებით გაიგზავნა');
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
    public function destroy(string $language, Visitor $visitor)
    {
        $visitor -> delete();
        return redirect() -> route('visitors.index',['language' => app() -> getLocale()]) -> with('success', 'ვიზიტორი წარმატებით წაიშალა.');
    }
}
