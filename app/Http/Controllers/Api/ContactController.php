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
                'success' => false,
                'message' => 'Contact information not found',
                'data' => null
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved contact information',
            'data' => new ContactResource($contact)
        ]);
    }
} 