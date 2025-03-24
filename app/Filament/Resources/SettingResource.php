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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditSetting::route('/'),
        ];
    }
} 