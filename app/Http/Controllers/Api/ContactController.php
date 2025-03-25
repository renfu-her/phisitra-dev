<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        
        if (!$contact) {
            return response()->json([
                'status' => false,
                'message' => 'Contact information not found',
                'data' => null
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved contact information',
            'data' => new ContactResource($contact)
        ]);
    }
} 