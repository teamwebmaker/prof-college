<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employers.index', [
           'employers' => Employer::orderBy('id', 'DESC')->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployerRequest $request)
    {
        $data = $request -> validated();
        $storeData = [
            'title' => $data['title'],
            'image' => null,
            'url' => null
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/employers';
            $image->move(public_path($uploadPath), $imageName);
        }else {
            $imageName = 'no-image.jpg';
        }

        $storeData = [...$storeData, 'image' => $imageName];
        if ($data['url']) {
            Employer::create([...$storeData, 'url' => $data['url']]);
        }
        else {
            Employer::create($storeData);
        }

        return redirect()->route('employers.index', ['language' => app() -> getLocale()])->with('success', 'staff added');
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
    public function edit(string $language, Employer $employer)
    {
        return view('admin.employers.edit',[
           'employer' => $employer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployerRequest $request,string $language, Employer $employer)
    {
        $data = $request -> validated();
        $storeData = [
            'title' => $data['title'],
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/employers/';
            $image->move(public_path($uploadPath), $imageName);
            $storeData = [...$storeData, 'image' => $imageName];
        }

        if ($data['url']) {
            $employer -> update([...$storeData, 'url' => $data['url']]);
        }
        else {
            $employer -> update($storeData);
        }

        return redirect()->back()->with('success', 'staff added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Employer $employer)
    {
        $employer -> delete();
        return redirect() -> route('employers.index', ['language' => app() -> getLocale()]) -> with('success', 'დამსაქმებელი წარმატებით წაიშალა.');
    }
}
