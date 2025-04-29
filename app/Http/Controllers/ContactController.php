<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Process the contact form submission
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Send email to admin
            Mail::to("med10hamouch@gmail.com")->send(new ContactFormMail($validated));

            return redirect()->route('contact')->with('success', 'Your message has been sent! We will get back to you soon.');
        } catch (\Exception $e) {
            // Log the error
            logger()->error('Failed to send contact email: ' . $e->getMessage());

            return redirect()->route('contact')
                ->with('error', 'Sorry, there was a problem sending your message. Please try again later.')
                ->withInput();
        }
    }
}