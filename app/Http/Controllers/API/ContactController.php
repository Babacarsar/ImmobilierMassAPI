<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
            'property_title' => 'nullable|string'
        ]);

        // TODO: Envoyer email (on fera plus tard)
        // Mail::to('contact@votreagence.com')->send(new ContactMail($data));

        return response()->json([
            'message' => 'Message envoyé avec succès !'
        ], 200);
    }
}
