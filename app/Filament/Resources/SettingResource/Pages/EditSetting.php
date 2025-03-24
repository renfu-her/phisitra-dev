<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class EditSetting extends Page
{
    protected static string $resource = SettingResource::class;
    protected static ?string $title = '網站設定';
    protected static ?string $slug = 'settings';
    protected static string $view = 'filament.resources.setting-resource.pages.edit-setting';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Phisitra',
                'logo' => null,
                'favicon' => null,
                'meta_title' => 'Phisitra - 國際學生管理系統',
                'meta_description' => 'Phisitra 是一個專業的國際學生管理系統，提供完整的學生管理解決方案。',
                'meta_keywords' => '國際學生,學生管理,Phisitra',
            ]
        );

        $this->form->fill($setting->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('基本設定')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('網站名稱')
                            ->required(),
                        FileUpload::make('logo')
                            ->label('網站 Logo')
                            ->image()
                            ->directory('settings')
                            ->imageEditor(),
                        FileUpload::make('favicon')
                            ->label('網站 Favicon')
                            ->image()
                            ->directory('settings')
                            ->imageEditor(),
                    ])->columns(2),

                Section::make('SEO 設定')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta 標題'),
                        Textarea::make('meta_description')
                            ->label('Meta 描述'),
                        TextInput::make('meta_keywords')
                            ->label('Meta 關鍵字'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $setting = Setting::firstOrCreate(['id' => 1]);
        $setting->update($data);

        Cache::forget('settings');

        Notification::make()
            ->title('設定已更新')
            ->success()
            ->send();
    }
} 