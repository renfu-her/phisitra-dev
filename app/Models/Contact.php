<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_zh',          // 中文名稱
        'name_en',          // 英文名稱
        'address',          // 地址
        'phone',            // 電話
        'fax',             // 傳真
        'email',           // Email
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    protected $casts = [
        'status' => 'string',
    ];
} 