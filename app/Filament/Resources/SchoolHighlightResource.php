<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolHighlightResource\Pages;
use App\Models\SchoolHighlight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolHighlightResource extends Resource
{
    protected static ?string $model = SchoolHighlight::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationGroup = '合作學校';
    
    protected static ?string $modelLabel = '合作花絮';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\Textarea::make('description')
                    ->label('描述')
                    ->rows(3),
                    
                Forms\Components\Select::make('media_type')
                    ->label('媒體類型')
                    ->options([
                        'image' => '圖片',
                        'video' => '影片'
                    ])
                    ->required()
                    ->live(),
                    
                Forms\Components\FileUpload::make('media_path')
                    ->label('媒體檔案')
                    ->image()
                    ->imageEditor()
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'image')
                    ->directory('school-highlights')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']),
                    
                Forms\Components\FileUpload::make('media_path')
                    ->label('媒體檔案')
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video')
                    ->directory('school-highlights')
                    ->acceptedFileTypes(['video/mp4']),
                    
                Forms\Components\TextInput::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->default(0),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('標題')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('media_type')
                    ->label('媒體類型')
                    ->formatStateUsing(fn (string $state): string => $state === 'image' ? '圖片' : '影片'),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('排序')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
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
            'index' => Pages\ListSchoolHighlights::route('/'),
            'create' => Pages\CreateSchoolHighlight::route('/create'),
            'edit' => Pages\EditSchoolHighlight::route('/{record}/edit'),
        ];
    }
} 