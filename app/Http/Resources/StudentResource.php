<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo,
            'name_zh' => $this->name_zh,
            'name_en' => $this->name_en,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'nationality' => $this->nationality,
            'passport_no' => $this->passport_no,
            'overseas_address' => $this->overseas_address,
            'school_name' => $this->school_name,
            'department' => $this->department,
            'enrollment_date' => $this->enrollment_date,
            'study_duration' => $this->study_duration,
            'expected_graduation_date' => $this->expected_graduation_date,
            'specialties' => $this->specialties,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'members' => MemberResource::collection($this->whenLoaded('members')),
        ];
    }
} 