<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'address',
        'google_map_link',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    protected $casts = [
        'status' => 'string',
    ];
} 