<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationGroup = '學生管理';
    
    protected static ?string $modelLabel = '學生';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 基本資料區段
                Forms\Components\Section::make('基本資料')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('照片')
                            ->image()
                            ->imageEditor()
                            ->directory('students')
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('name_zh')
                            ->label('中文姓名')
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('name_en')
                            ->label('英文姓名')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\Select::make('gender')
                            ->label('性別')
                            ->options([
                                'male' => '男',
                                'female' => '女',
                                'other' => '其他'
                            ])
                            ->required(),

                        Flatpickr::make('birth_date')
                            ->label('出生日期')
                            ->required()
                            ->dateFormat('Y-m-d')
                            ->altFormat('Y-m-d')
                            ->noCalendar(false)
                            ->enableTime(false),
                            
                        Forms\Components\TextInput::make('nationality')
                            ->label('國籍')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('passport_no')
                            ->label('護照號碼')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\Textarea::make('overseas_address')
                            ->label('國外居住處所')
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ])->columns(2),

                // 學歷資料區段
                Forms\Components\Section::make('學歷資料')
                    ->schema([
                        Forms\Components\TextInput::make('school_name')
                            ->label('就讀學校')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('department')
                            ->label('科系')
                            ->required()
                            ->maxLength(255),
                            
                        Flatpickr::make('enrollment_date')
                            ->label('入學日期')
                            ->required()
                            ->dateFormat('Y-m-d')
                            ->altFormat('Y-m-d')
                            ->noCalendar(false)
                            ->enableTime(false),
                            
                        Forms\Components\TextInput::make('study_duration')
                            ->label('學制年限')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                            
                        Flatpickr::make('expected_graduation_date')
                            ->label('預計畢業時間')
                            ->required()
                            ->dateFormat('Y-m-d')
                            ->altFormat('Y-m-d')
                            ->noCalendar(false)
                            ->enableTime(false),
                    ])->columns(2),

                // 其他資料區段
                Forms\Components\Section::make('其他資料')
                    ->schema([
                        Forms\Components\Textarea::make('specialties')
                            ->label('專長')
                            ->rows(3),
                            
                        Forms\Components\Textarea::make('remarks')
                            ->label('標註')
                            ->rows(3),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('照片')
                    ->height('auto')
                    ->width('auto')
                    ->square()
                    ->extraImgAttributes(['style' => 'width: 100px; height: auto;']),
                    
                Tables\Columns\TextColumn::make('name_zh')
                    ->label('中文姓名')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('name_en')
                    ->label('英文姓名')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('gender')
                    ->label('性別'),
                    
                Tables\Columns\TextColumn::make('nationality')
                    ->label('國籍')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('school_name')
                    ->label('就讀學校')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('department')
                    ->label('科系')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('enrollment_date')
                    ->label('入學日期')
                    ->date('Y-m-d')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('expected_graduation_date')
                    ->label('預計畢業時間')
                    ->date('Y-m-d')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
} 