<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'icon',
        'order',
        'is_active',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected function getDefaultSeoDescription(): string
    {
        return $this->meta_description ?? $this->description ?? '';
    }
} 