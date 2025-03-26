<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeServiceResource\Pages;
use App\Filament\Resources\HomeServiceResource\RelationManagers;
use App\Models\HomeService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeServiceResource extends Resource
{
    protected static ?string $model = HomeService::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = '首頁服務';
    
    protected static ?string $modelLabel = '首頁服務';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('icon')
                    ->label('圖標')
                    ->required()
                    ->helperText(view('filament.components.fontawesome-helper')->render())
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('sub_title')
                    ->label('副標題')
                    ->maxLength(65535),
                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->default(true),
                Forms\Components\TextInput::make('sort')
                    ->label('排序')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('圖標')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('標題')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_title')
                    ->label('副標題')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('啟用')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort')
                    ->label('排序')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort', 'asc');
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
            'index' => Pages\ListHomeServices::route('/'),
            'create' => Pages\CreateHomeService::route('/create'),
            'edit' => Pages\EditHomeService::route('/{record}/edit'),
        ];
    }
}
