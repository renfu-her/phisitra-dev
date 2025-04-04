<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Member;
use App\Models\StudentMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 12); // 每頁顯示12筆資料
        $currentPage = $request->input('page', 1);

        $students = Student::paginate($perPage, ['*'], 'page', $currentPage);

        return response()->json([
            'status' => 'success',
            'data' => [
                'data' => $students->items(),
                'meta' => [
                    'current_page' => $students->currentPage(),
                    'from' => $students->firstItem(),
                    'last_page' => $students->lastPage(),
                    'per_page' => $students->perPage(),
                    'to' => $students->lastItem(),
                    'total' => $students->total()
                ]
            ]
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
        
        $member = Auth::guard('member')->user();
        
        if (!$member) {
            return response()->json([
                'status' => 'error',
                'message' => '請先登入'
            ], 401);
        }

        try {
            // 檢查是否已存在關聯
            $studentMember = StudentMember::where('student_id', $student->id)
                ->where('member_id', $member->id)
                ->first();
            
            if ($studentMember) {
                // 如果已存在，則刪除
                $studentMember->delete();
                
                return response()->json([
                    'status' => 'success',
                    'message' => '已取消勾選學生',
                    'is_selected' => false
                ]);
            } else {
                // 如果不存在，則建立
                StudentMember::create([
                    'student_id' => $student->id,
                    'member_id' => $member->id
                ]);
                
                return response()->json([
                    'status' => 'success',
                    'message' => '已成立學生資料',
                    'is_selected' => true
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => '操作失敗：' . $e->getMessage()
            ], 500);
        }
    }

    public function getSelectedStudents()
    {
        $member = Auth::guard('member')->user();
        
        if (!$member) {
            return response()->json([
                'status' => 'error',
                'message' => '請先登入'
            ], 401);
        }

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