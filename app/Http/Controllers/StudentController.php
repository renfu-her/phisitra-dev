<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentMember;

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
        $response = Http::withoutVerifying()->get($this->apiUrl . '/students/' . $student->id)->json();    
        
        $student = $response['data'];

        // 檢查會員是否已登入
        if (Auth::guard('member')->check()) {
            $member = Auth::guard('member')->user();
            // 檢查是否已選擇此學生
            $studentMember = StudentMember::where('student_id', $student['id'])
                ->where('member_id', $member->id)
                ->first();
            
            $student['is_selected'] = $studentMember ? true : false;
        }

        return view('students.show', compact('student'));
    }

    public function toggleStudent(Student $student){
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
                    'message' => '已勾選學生',
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
} 