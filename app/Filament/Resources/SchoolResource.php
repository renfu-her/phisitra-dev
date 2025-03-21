<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationGroup = '合作學校';
    
    protected static ?string $modelLabel = '合作學校';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('學校名稱')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\FileUpload::make('logo')
                    ->label('學校標誌')
                    ->image()
                    ->directory('schools/logos')
                    ->columnSpanFull(),
                    
                Forms\Components\RichEditor::make('description')
                    ->label('描述')
                    ->columnSpanFull(),
                    
                Forms\Components\TextInput::make('website_url')
                    ->label('網站連結')
                    ->url()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('location')
                    ->label('地點')
                    ->maxLength(255),
                    
                Forms\Components\DatePicker::make('cooperation_date')
                    ->label('合作日期'),
                    
                Forms\Components\TextInput::make('order')
                    ->label('排序')
                    ->numeric()
                    ->default(0),
                    
                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('學校名稱')
                    ->searchable(),
                    
                Tables\Columns\ImageColumn::make('logo')
                    ->label('學校標誌'),
                    
                Tables\Columns\TextColumn::make('location')
                    ->label('地點')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('cooperation_date')
                    ->label('合作日期')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('order')
                    ->label('排序')
                    ->sortable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('狀態')
                    ->boolean(),
            ])
            ->defaultSort('order')
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
} 