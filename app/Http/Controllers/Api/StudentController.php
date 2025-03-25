<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id')->where('is_active', 1)->get();
        
        if ($students->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No students found',
                'data' => []
            ]);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved students list',
            'data' => StudentResource::collection($students)
        ]);
    }
    
    public function show(Student $student)
    {
        $student->load('members');
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved student details',
            'data' => new StudentResource($student)
        ]);
    }
} 