<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'member_id'
    ];

    /**
     * 取得關聯的學生
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * 取得關聯的會員
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
} 