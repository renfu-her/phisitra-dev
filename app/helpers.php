<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Cache::rememberForever('settings', function () {
            return Setting::where('group', 'general')->get()->pluck('value', 'key')->toArray();
        })[$key] ?? $default;
    }
} 