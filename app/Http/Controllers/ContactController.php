<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactMail;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
       $this->validate($request, [
        "name" => "required",
        "email" => "required|email",
        "phone" => "required|digits:10",
        "subject" => "required",
        "message" => "required",
       ]);

       $contact = Contact::create($request->all());

       $email_data["name"] = $contact->name;
       $email_data["email"] = $contact->email;
       $email_data["phone"] = $contact->phone;
       $email_data["subject"] = $contact->subject;
       $email_data["message"] = $contact->message;

       SendContactMail::dispatch($contact->toArray());

       return \redirect()->back()->with("success", "Your message sent successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
