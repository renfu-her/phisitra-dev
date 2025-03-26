<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name_zh',
        'name_en',
        'gender',
        'birth_date',
        'nationality',
        'passport_no',
        'school_name',
        'department',
        'enrollment_date',
        'study_duration',
        'expected_graduation_date',
        'specialties',
        'remarks'
    ];

    protected $casts = [
        'birth_date' => 'date:Y-m-d',
        'enrollment_date' => 'date:Y-m-d',
        'expected_graduation_date' => 'date:Y-m-d',
    ];

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function setEnrollmentDateAttribute($value)
    {
        $this->attributes['enrollment_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function setExpectedGraduationDateAttribute($value)
    {
        $this->attributes['expected_graduation_date'] = $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($student) {
            if ($student->isDirty('photo') && $student->photo) {
                $path = Storage::disk('public')->path($student->photo);
                
                if (file_exists($path)) {
                    // 創建圖片管理器實例
                    $manager = new ImageManager(new Driver());
                    
                    // 讀取圖片
                    $image = $manager->read($path);
                    
                    // 生成新的檔案名稱（使用 UUID v7）
                    $newFileName = Str::uuid7() . '.webp';
                    $webpPath = Storage::disk('public')->path('students/' . $newFileName);
                    
                    // 轉換為 WebP 並保存
                    $image->toWebp(90)->save($webpPath);
                    
                    // 刪除原始檔案
                    @unlink($path);
                    
                    // 更新數據庫中的檔案路徑
                    $student->photo = 'students/' . $newFileName;
                }
            }
        });
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'student_members')
            ->withTimestamps();
    }

    // 獲取公開資料
    public function getPublicData(): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'name_zh' => $this->name_zh,
            'name_en' => $this->name_en,
        ];
    }

    // 獲取完整資料
    public function getFullData(): array
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'name_zh' => $this->name_zh,
            'name_en' => $this->name_en,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'nationality' => $this->nationality,
            'passport_no' => $this->passport_no,
            'school_name' => $this->school_name,
            'department' => $this->department,
            'enrollment_date' => $this->enrollment_date,
            'study_duration' => $this->study_duration,
            'expected_graduation_date' => $this->expected_graduation_date,
            'specialties' => $this->specialties,
            'remarks' => $this->remarks,
        ];
    }
} 