<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Contact;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 從快取中獲取設定，如果快取不存在則從資料庫獲取並快取
        View::composer('*', function ($view) {
            $setting = Cache::remember('site_settings', 3600, function () {
                return Setting::first() ?? new Setting();
            });
            
            $contact = Contact::where('id', 1)->first();
            $view->with('setting', $setting);
            $view->with('contact', $contact);
        });
    }
}
