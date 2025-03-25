<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $navigationGroup = '學生管理';
    
    protected static ?string $modelLabel = '學生';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                    ->label('照片')
                    ->image()
                    ->imageEditor()
                    ->directory('students/photos')
                    ->columnSpanFull()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable()
                    ->openable()
                    ->getUploadedFileNameForStorageUsing(
                        fn($file): string => (string) str(Str::uuid7() . '.webp')
                    )
                    ->saveUploadedFileUsing(function ($file) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($file);
                        $image->cover(800, 800);
                        $filename = Str::uuid7()->toString() . '.webp';

                        if (!file_exists(storage_path('app/public/students/photos'))) {
                            mkdir(storage_path('app/public/students/photos'), 0755, true);
                        }

                        $image->toWebp(80)->save(storage_path('app/public/students/photos/' . $filename));
                        return 'students/photos/' . $filename;
                    })
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file) {
                            Storage::disk('public')->delete($file);
                        }
                    }),
                    
                Forms\Components\TextInput::make('name_zh')
                    ->label('中文姓名')
                    ->required()
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
                    ])
                    ->required(),
                    
                Forms\Components\DatePicker::make('birth_date')
                    ->label('出生日期')
                    ->required(),
                    
                Forms\Components\TextInput::make('nationality')
                    ->label('國籍')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('passport_no')
                    ->label('護照號碼')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\Textarea::make('overseas_address')
                    ->label('海外地址')
                    ->nullable()
                    ->rows(3),
                    
                Forms\Components\TextInput::make('school_name')
                    ->label('學校名稱')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('department')
                    ->label('科系')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\DatePicker::make('enrollment_date')
                    ->label('入學日期')
                    ->required(),
                    
                Forms\Components\TextInput::make('study_duration')
                    ->label('就讀年限')
                    ->required()
                    ->numeric(),
                    
                Forms\Components\DatePicker::make('expected_graduation_date')
                    ->label('預計畢業日期')
                    ->required(),
                    
                Forms\Components\Textarea::make('specialties')
                    ->label('專長')
                    ->rows(3),
                    
                Forms\Components\Textarea::make('remarks')
                    ->label('備註')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('照片'),
                    
                Tables\Columns\TextColumn::make('name_zh')
                    ->label('中文姓名')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('name_en')
                    ->label('英文姓名')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('nationality')
                    ->label('國籍')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('school_name')
                    ->label('學校名稱')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('department')
                    ->label('科系')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('enrollment_date')
                    ->label('入學日期')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('expected_graduation_date')
                    ->label('預計畢業日期')
                    ->date()
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