<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use App\Http\Requests\ContactsRequest;
use Illuminate\View\View;
use Monolog\Handler\WebRequestRecognizerTrait;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View("contacts.index", [
            "contacts" => Contacts::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return View("contacts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // die("Aqui");
        Contacts::create($request->validate(
            [
                "name"=>"required|string|max:255|min:5",
                "email"=>"required|email|unique:contacts,email",
                "number"=>"required|string|max:9|min:9|unique:contacts,number",
            ]
        ));
        return to_route("contacts.index")->with("success","Contact created successfully");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contacts $contact)
    {
        return view("contacts.edit", compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contacts $contact)
    {
        // die($contact);
        $validated = $request->validate([
            "name" => "required|string|max:255|min:5",
            // Ignora o próprio contato na validação do email
            "email" => "required|email|unique:contacts,email,".$contact->id,
            "number" => "required|string|max:9|min:9|unique:contacts,number,".$contact->id,
        ]);

        $contact->update($validated);

        return redirect()->route("contacts.index")
                         ->with("success","Contact updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contacts $contact)
    {
        $contact->delete();
        return to_route("contacts.index")->with("success","Contact deleted successfully");
    }
}
