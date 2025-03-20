<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'website_url',
        'location',
        'cooperation_date',
        'order',
        'is_active',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'cooperation_date' => 'date'
    ];

    public function getSeoTitle(): string
    {
        return $this->seo_title ?? $this->name;
    }

    public function getSeoDescription(): string
    {
        return $this->seo_description ?? $this->description ?? '';
    }

    public function getSeoKeywords(): ?string
    {
        return $this->seo_keywords;
    }
} 