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
            'english_name' => $this->english_name,
            'chinese_name' => $this->chinese_name,
            'photo' => $this->photo,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'passport_number' => $this->passport_number,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'emergency_contact' => $this->emergency_contact,
            'emergency_phone' => $this->emergency_phone,
            'members' => MemberResource::collection($this->whenLoaded('members')),
        ];
    }
} 