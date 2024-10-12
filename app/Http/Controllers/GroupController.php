<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Profession;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.groups.index', [
            'groups' => Group::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.groups.create',[
            'professions' => Profession::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'number' => 'required|integer',
            'table' => 'required|file',
            'profession_id' => 'required'
        ]);

        if ($request->hasFile('table')) {
            $file = $request->file('table');
            $type = $file->getClientOriginalExtension();
            $fileName = uniqid() . '-' . time() .'.'. $file->getClientOriginalExtension();
            $uploadPath = 'docs/groups/tables' . $request -> uuid;
            $file->move(public_path($uploadPath), $fileName);
            if($uploadPath){
                Group::create([
                    'number' => $data['number'],
                    'table' => $fileName,
                    'profession_id' => $data['profession_id']
                ]);
                return redirect() -> route('groups.index', ['language' => app() -> getLocale()]) -> with('success', 'ჯგუფი წარმატებით დაემატა');
            }
        }
        return redirect() -> back() -> with('error', 'ჯგუფის დამატება ვერ მოხერხდა');
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
    public function edit(string $language, Group $group)
    {
        return view('admin.groups.edit',[
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $language, Group $group)
    {
        $data = $request -> validate([
            'number' => 'required|integer',
            'table' => 'nullable|file',
            'profession_id' => 'required'
        ]);

        if ($request->hasFile('table')) {
            $file = $request->file('table');
            $type = $file->getClientOriginalExtension();
            $fileName = uniqid() . '-' . time() .'.'. $file->getClientOriginalExtension();
            $uploadPath = 'docs/groups/tables' . $request -> uuid;
            $file->move(public_path($uploadPath), $fileName);
            if($uploadPath){
                $group -> update([
                    'number' => $data['number'],
                    'table' => $fileName,
                    'profession_id' => $data['profession_id']
                ]);
                return redirect() -> back() -> with('success', 'ჯგუფი წარმატებით განახლდა');
            } else return redirect() -> back() -> with('error', 'ჯგუფის განახლება ვერ მოხერხდა');
        }
        $group -> update([
            'number' => $data['number'],
            'profession_id' => $data['profession_id']
        ]);
        return redirect() -> back() -> with('success', 'ჯგუფი წარმატებით განახლდა');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $language, Group $group)
    {
        $group -> delete();
        return redirect() -> route('groups.index', ['language' => app() -> getLocale()]) -> with('success', 'ჯგუფი წარმატებით წაიშალა.');
    }
}
