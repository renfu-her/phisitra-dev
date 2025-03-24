<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
                    ->imageEditor()
                    ->directory('schools/logos')
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

                        if (!file_exists(storage_path('app/public/schools/logos'))) {
                            mkdir(storage_path('app/public/schools/logos'), 0755, true);
                        }

                        $image->toWebp(80)->save(storage_path('app/public/schools/logos/' . $filename));
                        return 'schools/logos/' . $filename;
                    })
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file) {
                            Storage::disk('public')->delete($file);
                        }
                    }),
                    
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
            ->defaultSort('order', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('排序')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('學校名稱')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo')
                    ->label('學校標誌'),
                Tables\Columns\TextColumn::make('location')
                    ->label('地點')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('啟用'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('啟用狀態')
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('編輯'),
                Tables\Actions\DeleteAction::make()
                    ->label('刪除'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('刪除所選'),
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