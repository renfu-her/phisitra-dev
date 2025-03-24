<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'site_name' => 'Phisitra',
            'logo' => null,
            'favicon' => null,
            'meta_title' => 'Phisitra - 國際學生管理系統',
            'meta_description' => 'Phisitra 是一個專業的國際學生管理系統，提供完整的學生管理解決方案。',
            'meta_keywords' => '國際學生,學生管理,Phisitra',
        ]);

        Cache::forget('settings');
    }
} 