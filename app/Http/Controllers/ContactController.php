<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Save to Database first (Reliability)
        \App\Models\ContactMessage::create($validated);

        // Try to send email (Best effort)
        try {
            Mail::to('info@wickejeroen.be')->send(new ContactFormMail($validated));
        } catch (\Exception $e) {
            // Log error but don't fail the request since DB save worked
            \Illuminate\Support\Facades\Log::error('Mail send failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Bedankt! Uw bericht is goed ontvangen. We nemen snel contact met u op.');
    }
}
