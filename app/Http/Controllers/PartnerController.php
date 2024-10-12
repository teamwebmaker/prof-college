<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.partners.index',[
            'partners' => Partner::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $data = $request -> validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/partners';
            $image->move(public_path($uploadPath), $imageName);
            Partner::create([
                'title' => $data['title'],
                'image' => $imageName,
                'url' => $data['url']
            ]);
        }
        return redirect()->route('partners.index',['language' => app() -> getLocale()])->with('success', 'partner added');
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
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit',[
           'partner' => $partner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $data = $request -> validated();
        $storeData = [
            'title' => $data['title'],
            'url' => $data['url']
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
            $uploadPath = 'images/employers/';
            $image->move(public_path($uploadPath), $imageName);
            $storeData = [...$storeData, 'image' => $imageName];
        }

        $partner -> update($storeData);

        return redirect()->back()->with('success', 'partner added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Partner $partner)
    {
        $partner -> delete();
        return redirect() -> route('partners.index',['language' => app() -> getLocale()]) -> with('success', 'პარტნიორი წარმატებით წაიშალა.');
    }

}
