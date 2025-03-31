<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',             // 姓名
        'email',           // 電子郵件
        'phone',           // 電話
        'subject',         // 主旨
        'message',         // 訊息
        'status',          // 狀態
        'reply',           // 回覆內容
        'replied_at',      // 回覆時間
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'status' => 'string',
    ];
}
