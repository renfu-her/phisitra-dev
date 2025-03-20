<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getSeoTitle(): string
    {
        return $this->seo_title ?? $this->title;
    }

    public function getSeoDescription(): string
    {
        return $this->seo_description ?? $this->content ?? '';
    }

    public function getSeoKeywords(): ?string
    {
        return $this->seo_keywords;
    }
} 