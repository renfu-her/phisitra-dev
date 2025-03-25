<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = '聯絡資訊';
    protected static ?string $modelLabel = '聯絡資訊';
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('基本資訊')
                    ->schema([
                        Forms\Components\TextInput::make('name_zh')
                            ->label('中文名稱')
                            ->required(),
                        Forms\Components\TextInput::make('name_en')
                            ->label('英文名稱')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('地址')
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('電話')
                            ->required(),
                        Forms\Components\TextInput::make('fax')
                            ->label('傳真')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),
                    ]),
                Forms\Components\Section::make('SEO 設定')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO 標題'),
                        Forms\Components\Textarea::make('seo_description')
                            ->label('SEO 描述'),
                        Forms\Components\TextInput::make('seo_keywords')
                            ->label('SEO 關鍵字'),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditContact::route('/edit/{record}'),
        ];
    }
} 