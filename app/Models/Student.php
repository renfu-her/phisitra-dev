<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

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
        'overseas_address',
        'school_name',
        'department',
        'enrollment_date',
        'study_duration',
        'expected_graduation_date',
        'specialties',
        'remarks'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'enrollment_date' => 'date',
        'expected_graduation_date' => 'date',
    ];

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
                    
                    // 調整大小，保持比例，最大 800x800
                    $image->scale(width: 800, height: 800);
                    
                    // 轉換為 WebP 並保存
                    $webpPath = preg_replace('/\.[^.]+$/', '.webp', $path);
                    $image->toWebp(90)->save($webpPath);
                    
                    // 更新數據庫中的檔案路徑
                    $student->photo = preg_replace('/\.[^.]+$/', '.webp', $student->photo);
                }
            }
        });
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class)
            ->withTimestamps();
    }

    // 獲取公開資料
    public function getPublicData(): array
    {
        return [
            'name_zh' => $this->name_zh,
            'name_en' => $this->name_en,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
        ];
    }

    // 獲取完整資料
    public function getFullData(): array
    {
        return [
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
        ];
    }
} 