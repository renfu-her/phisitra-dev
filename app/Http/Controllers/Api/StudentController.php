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
        $students = Student::all();
        $member = Auth::user();

        if (!$member) {
            // 未登入用戶只能看到公開資料
            $data = $students->map(function ($student) {
                return $student->getPublicData();
            });
        } else {
            // 已登入用戶可以看到更多資料
            $data = $students->map(function ($student) use ($member) {
                // 檢查會員是否有勾選此學生
                $isSelected = $member->students()->where('student_id', $student->id)->exists();

                if ($isSelected) {
                    // 如果已勾選，返回完整資料
                    return $student->getFullData();
                } else {
                    // 如果未勾選，只返回公開資料
                    return $student->getPublicData();
                }
            });
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function show(Student $student)
    {
        $student = Student::find($student->id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieved student details',
            'data' => $student
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
            return $student->getFullData();
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
} 