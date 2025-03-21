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
                'message' => '找不到聯絡資訊',
                'data' => null
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => '成功取得聯絡資訊',
            'data' => new ContactResource($contact)
        ]);
    }
} 