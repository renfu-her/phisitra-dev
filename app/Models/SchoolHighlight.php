<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SchoolHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'media_type',
        'media_path',
        'highlight_date',
        'sort_order'
    ];

    protected $casts = [
        'highlight_date' => 'date:Y-m-d',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($highlight) {
            if ($highlight->isDirty('media_path') && $highlight->media_path) {
                $path = Storage::disk('public')->path($highlight->media_path);
                
                if (file_exists($path)) {
                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $newFileName = Str::uuid7() . '.' . $extension;
                    $newPath = 'school-highlights/' . $newFileName;
                    
                    if ($highlight->media_type === 'image') {
                        // 處理圖片
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($path);
                        
                        // 轉換為 WebP
                        $newFileName = Str::uuid7() . '.webp';
                        $newPath = 'school-highlights/' . $newFileName;
                        $webpPath = Storage::disk('public')->path($newPath);
                        $image->toWebp(90)->save($webpPath);
                        
                        // 刪除原始檔案
                        @unlink($path);
                    } elseif ($highlight->media_type === 'video') {
                        // 直接移動影片檔案
                        Storage::disk('public')->move($highlight->media_path, $newPath);
                    }
                    
                    $highlight->media_path = $newPath;
                }
            }
        });
    }
} 