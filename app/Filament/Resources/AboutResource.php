<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    
    protected static ?string $navigationGroup = '網站管理';
    
    protected static ?string $modelLabel = '關於我們';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\FileUpload::make('image')
                    ->label('圖片')
                    ->image()
                    ->directory('about')
                    ->columnSpanFull(),
                    
                Forms\Components\RichEditor::make('content')
                    ->label('內容')
                    ->required()
                    ->columnSpanFull(),
                    
                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->default(true),

                Forms\Components\Section::make('SEO 設置')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO 標題')
                            ->maxLength(255)
                            ->helperText('留空將使用上方的標題'),
                            
                        Forms\Components\Textarea::make('seo_description')
                            ->label('SEO 描述')
                            ->rows(3),
                            
                        Forms\Components\TextInput::make('seo_keywords')
                            ->label('SEO 關鍵字')
                            ->placeholder('以逗號分隔關鍵字')
                            ->maxLength(255),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('標題')
                    ->searchable(),
                    
                Tables\Columns\ImageColumn::make('image')
                    ->label('圖片'),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('狀態')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
} 