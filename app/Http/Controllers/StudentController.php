<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    protected $apiUrl = 'https://phisitra.dev-vue.com/api/v1';

    public function index()
    {
        $response = Http::withoutVerifying()->get($this->apiUrl . '/students')->json();
        $students = $response['data'];
        return view('students.index', compact('students'));
    }

    public function show(Student $student)
    {

        dd($student);
        
        $response = Http::withoutVerifying()->get($this->apiUrl . '/students/' . $student->id)->json();
        $student = $response['data'];

        return view('students.show', compact('student'));
    }
} 