<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeService extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'sub_title',
        'is_active',
        'sort'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort' => 'integer'
    ];
}
