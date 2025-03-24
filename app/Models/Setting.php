<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'logo' => 'string',
        'favicon' => 'string',
    ];
} 