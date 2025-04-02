<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    protected $apiUrl = 'https://phisitra.dev-vue.com/api/v1';

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $response = Http::withoutVerifying()->get($this->apiUrl . '/students', [
            'page' => $page,
            'per_page' => 12
        ])->json();
        
        $studentsData = $response['data']['data'];
        $pagination = $response['data']['meta'];
        
        // 將陣列資料轉換為 Student 模型實例
        $students = collect($studentsData)->map(function ($studentData) {
            $student = new Student();
            $student->id = $studentData['id'] ?? null;
            $student->name_zh = $studentData['name_zh'] ?? '';
            $student->name_en = $studentData['name_en'] ?? '';
            $student->gender = $studentData['gender'] ?? null;
            $student->school_name = $studentData['school_name'] ?? null;
            $student->photo = $studentData['photo'] ?? null;
            $student->department = $studentData['department'] ?? null;
            $student->nationality = $studentData['nationality'] ?? null;
            $student->birth_date = $studentData['birth_date'] ?? null;
            $student->passport_no = $studentData['passport_no'] ?? null;
            $student->overseas_address = $studentData['overseas_address'] ?? null;
            $student->enrollment_date = $studentData['enrollment_date'] ?? null;
            $student->study_duration = $studentData['study_duration'] ?? null;
            $student->expected_graduation_date = $studentData['expected_graduation_date'] ?? null;
            $student->specialties = $studentData['specialties'] ?? null;
            $student->remarks = $studentData['remarks'] ?? null;
            
            // 檢查是否已選擇此學生
            if (Auth::guard('member')->check()) {
                $member = Auth::guard('member')->user();
                $studentMember = StudentMember::where('student_id', $studentData['id'])
                    ->where('member_id', $member->id)
                    ->first();
                $student->setRelation('studentMember', $studentMember);
            }
            
            return $student;
        })->filter(function ($student) {
            // 只顯示未通過審核的學生
            if ($student->studentMember) {
                return !$student->studentMember->status;
            }
            return true;
        });

        return view('students.index', compact('students', 'pagination'));
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

    public function toggleStudent(Student $student)
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

    public function attach(Student $student)
    {
        $member = Auth::guard('member')->user();

        try {
            // 檢查是否已存在關聯
            $studentMember = StudentMember::where('student_id', $student->id)
                ->where('member_id', $member->id)
                ->first();

            if (!$studentMember) {
                // 如果不存在，則建立
                StudentMember::create([
                    'student_id' => $student->id,
                    'member_id' => $member->id,
                    'status' => false // 預設狀態為待審核
                ]);

                return response()->json([
                    'success' => true,
                    'message' => '已選擇學生'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => '已經選擇過此學生'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '操作失敗：' . $e->getMessage()
            ], 500);
        }
    }

    public function detach(Student $student)
    {
        $member = Auth::guard('member')->user();

        try {
            // 檢查是否已存在關聯
            $studentMember = StudentMember::where('student_id', $student->id)
                ->where('member_id', $member->id)
                ->first();

            if ($studentMember) {
                // 如果存在，則刪除
                $studentMember->delete();

                return response()->json([
                    'success' => true,
                    'message' => '已取消選擇學生'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => '尚未選擇此學生'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '操作失敗：' . $e->getMessage()
            ], 500);
        }
    }
}
