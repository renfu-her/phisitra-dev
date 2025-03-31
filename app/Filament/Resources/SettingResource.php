<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = '系統設定';
    protected static ?string $modelLabel = '網站設定';
    protected static ?string $pluralModelLabel = '網站設定';
    protected static ?string $slug = 'settings';

    public static function form(Form $form): Form
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
                            ->imageEditor()
                            ->directory('settings')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file): string => (string) str('logo-' . Str::uuid7() . '.webp')
                            )
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);
                                
                                // 如果寬度大於 500px，則等比例縮小到 500px
                                if ($image->width() > 500) {
                                    $image->scale(width: 500);
                                }

                                $filename = 'logo-' . Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/settings'))) {
                                    mkdir(storage_path('app/public/settings'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/settings/' . $filename));
                                return 'settings/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            }),
                        FileUpload::make('favicon')
                            ->label('網站 Favicon')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/x-icon'])
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file): string => (string) str('favicon-' . Str::uuid7() . '.webp')
                            )
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);
                                
                                // 正方形裁切
                                $size = min($image->width(), $image->height());
                                $image->cover($size, $size);
                                $image->resize(32, 32); // favicon 標準尺寸

                                $filename = 'favicon-' . Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/settings'))) {
                                    mkdir(storage_path('app/public/settings'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/settings/' . $filename));
                                return 'settings/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            }),
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditSetting::route('/'),
        ];
    }
} 