<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.contacts.index',[
            'contacts' => Contact::all()
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
        $data = $request -> validate([
            'full_name' => 'required|string|min:3|max:20',
            'subject' => 'required|string|min:3',
            'phone' => 'nullable|min:9|max:15',
            'email' => 'required|email',
            'message' => 'required|min:5'
        ]);
        $storeData = [
            'full_name' => $data['full_name'],
            'subject' => $data['subject'],
            'email' => $data['email'],
            'message' => $data['message']
        ];
        if($data['phone']) $storeData = [...$storeData, 'phone' => $data['phone']];
        Contact::create($storeData);
        return redirect() -> back() -> with('success', 'საკონტაქტო ინფორმაცია წარმატებით გაიგზავნა');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $language,Contact $contact)
    {
        return view('admin.contacts.show',[
            'contact' => $contact
        ]);
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
    public function destroy(string $language, Contact $contact)
    {
        $contact -> delete();
        return redirect() -> route('contacts.index', ['language' => app() -> getLocale()]) -> with('success', 'კონტაქტი წარმატებით წაიშალა.');
    }
}
