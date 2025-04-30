<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $contact = Contact::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        // Send email to admin
        Mail::to('admin@orangeacademy.com')->send(new ContactFormSubmitted($contact));

        return redirect()->route('contact.create')
            ->with('success', 'Your message has been sent successfully. We will contact you soon.');
    }

    public function index()
    {
        $contacts = Contact::with('user')->latest()->get();
        return view('contact.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('contact.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update(['status' => 'responded']);
        return back()->with('success', 'Contact marked as responded.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contact deleted successfully.');
    }
}