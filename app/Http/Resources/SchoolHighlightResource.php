<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolHighlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'media_type' => $this->media_type,
            'media_path' => $this->media_path,
            'sort_order' => $this->sort_order,
        ];
    }
} 