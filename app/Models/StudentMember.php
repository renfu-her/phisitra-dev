<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'member_id',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // 審核狀態常數
    const STATUS_PENDING = false;    // 待審核
    const STATUS_APPROVED = true;    // 已通過

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

    /**
     * 取得狀態文字
     */
    public function getStatusTextAttribute()
    {
        return $this->status ? '已通過' : '待審核';
    }

    /**
     * 取得狀態樣式
     */
    public function getStatusBadgeAttribute()
    {
        return $this->status ? 'success' : 'warning';
    }
} 