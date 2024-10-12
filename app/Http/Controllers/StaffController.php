<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Http\Exceptions\PostTooLargeException;
use App\Models\Article;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.staff.index',[
            'staff' => Staff::orderBy('id', 'DESC')->paginate(8)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        $data = $request -> validated();
        $full_name = ["ka" => $data['full_name_ka'], "en" => $data['full_name_en']];
        $position = ["ka" => $data['position_ka'], "en" => $data['position_en']];
        $storeData = [
            'full_name' => $full_name,
            'position' => $position,
            'email' => null,
            'image' => 'no-image.jpg',
        ];

        if ($request->hasFile('image')) {
            try{
                $image = $request->file('image');
                $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
                $uploadPath = 'images/staff';
                $uploadedImage = $image->move(public_path($uploadPath), $imageName);
                if($uploadedImage) $storeData = [...$storeData, 'image' => $imageName];
                else return redirect()->back()->with('error', 'სურათის ატვირთვა ვერ მოხერხდა');
            } catch (PostTooLargeException $e){
                return redirect()->back()->with('error', 'სურათის ზომა დასაშვებზე დიდია');
            }
        }

        if ($data['email']) {
            Staff::create([...$storeData, 'email' => $data['email']]);
        }
         else {
            Staff::create($storeData);
        }

        return redirect()->route('staff.index',['language' => app() -> getLocale()])->with('success', 'ადმინისტრაციის წევრი დაემატა წარმატებით');

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
    public function edit(string $language, Staff $staff)
    {
        return view('admin.staff.edit', [
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, string $language,  Staff $staff)
    {
        $data = $request -> validated();
        $full_name = ["ka" => $data['full_name_ka'], "en" => $data['full_name_en']];
        $position = ["ka" => $data['position_ka'], "en" => $data['position_en']];
        $storeData = [
            'full_name' => $full_name,
            'position' => $position,
            'email' => null,
            'image' => 'no-image.jpg',
        ];

        if ($request->hasFile('image')) {
            try{
                $image = $request->file('image');
                $imageName = uniqid() . '-' . time() .'.'. $image->getClientOriginalExtension();
                $uploadPath = 'images/staff/';
                $uploadedImage = $image->move(public_path($uploadPath), $imageName);
                if($uploadedImage) $storeData = [...$storeData, 'image' => $imageName];
                else return redirect()->back()->with('error', 'სურათის ატვირთვა ვერ მოხერხდა');
            } catch (PostTooLargeException $e){
                return redirect()->back()->with('error', 'სურათის ზომა დასაშვებზე დიდია');
            }
        }
        if ($data['email']) {
            $staff -> update([...$storeData, 'email' => $data['email']]);
        }
        else {
           $staff -> update($storeData);
        }

        return redirect()->back()->with('success', 'ადმინისტრაციის წევრი განახლდა წარმატებით');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Staff $staff)
    {
        $staff -> delete();
        return redirect() -> route('staff.index',['language' => app() -> getLocale()]) -> with('success', 'ადმინისტრაციის წევრი წარმატებით წაიშალა.');
    }
}
