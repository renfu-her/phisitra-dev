<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $member = Auth::user();
        $students = Student::all();

        $data = $students->map(function ($student) use ($member) {
            // 檢查會員是否有勾選此學生
            $isSelected = $member->students()->where('student_id', $student->id)->exists();

            if ($isSelected) {
                // 如果已勾選，返回完整資料
                return [
                    'id' => $student->id,
                    'photo' => $student->photo ? asset('storage/' . $student->photo) : null,
                    'name_zh' => $student->name_zh,
                    'name_en' => $student->name_en,
                    'gender' => $student->gender,
                    'birth_date' => $student->birth_date,
                    'nationality' => $student->nationality,
                    'passport_no' => $student->passport_no,
                    'overseas_address' => $student->overseas_address,
                    'school_name' => $student->school_name,
                    'department' => $student->department,
                    'enrollment_date' => $student->enrollment_date,
                    'study_duration' => $student->study_duration,
                    'expected_graduation_date' => $student->expected_graduation_date,
                    'specialties' => $student->specialties,
                    'remarks' => $student->remarks,
                ];
            } else {
                // 如果未勾選，只返回基本資料
                return [
                    'id' => $student->id,
                    'photo' => $student->photo ? asset('storage/' . $student->photo) : null,
                    'name_zh' => $student->name_zh,
                    'name_en' => $student->name_en,
                ];
            }
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function toggleStudent(Request $request, Student $student)
    {
        $member = Auth::user();
        
        // 檢查會員是否已勾選此學生
        $isSelected = $member->students()->where('student_id', $student->id)->exists();
        
        if ($isSelected) {
            // 如果已勾選，則取消勾選
            $member->students()->detach($student->id);
            $message = '已取消勾選學生';
        } else {
            // 如果未勾選，則勾選
            $member->students()->attach($student->id);
            $message = '已勾選學生';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'is_selected' => !$isSelected
        ]);
    }

    public function getSelectedStudents()
    {
        $member = Auth::user();
        $selectedStudents = $member->students()->get();

        $data = $selectedStudents->map(function ($student) {
            return [
                'id' => $student->id,
                'photo' => $student->photo ? asset('storage/' . $student->photo) : null,
                'name_zh' => $student->name_zh,
                'name_en' => $student->name_en,
                'gender' => $student->gender,
                'birth_date' => $student->birth_date,
                'nationality' => $student->nationality,
                'passport_no' => $student->passport_no,
                'overseas_address' => $student->overseas_address,
                'school_name' => $student->school_name,
                'department' => $student->department,
                'enrollment_date' => $student->enrollment_date,
                'study_duration' => $student->study_duration,
                'expected_graduation_date' => $student->expected_graduation_date,
                'specialties' => $student->specialties,
                'remarks' => $student->remarks,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
} 