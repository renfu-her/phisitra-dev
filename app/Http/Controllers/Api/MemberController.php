<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('id')->where('is_active', 1)->get();
        
        if ($members->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No members found',
                'data' => []
            ]);
        }
        
        return response()->json([
            'status' => true,
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