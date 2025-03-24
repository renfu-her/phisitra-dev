<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('students')->orderBy('id')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved members list',
            'data' => MemberResource::collection($members)
        ]);
    }
    
    public function show(Member $member)
    {
        $member->load('students');
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved member details',
            'data' => new MemberResource($member)
        ]);
    }
} 