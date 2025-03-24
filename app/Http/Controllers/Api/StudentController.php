<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('members')->orderBy('id')->get();
        
        return response()->json([
            'success' => true,
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