<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    
    protected static ?string $navigationGroup = '網站管理';
    
    protected static ?string $modelLabel = '服務項目';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('基本資訊')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('標題')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\FileUpload::make('image')
                            ->label('圖片')
                            ->image()
                            ->imageEditor()
                            ->directory('services')
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
                                $image->cover(800, 600);
                                $filename = Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/services'))) {
                                    mkdir(storage_path('app/public/services'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/services/' . $filename));
                                return 'services/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            }),
                            
                        Forms\Components\RichEditor::make('description')
                            ->label('描述')
                            ->required()
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('啟用')
                            ->default(true),
                    ]),
                    
                Forms\Components\Section::make('SEO 設定')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta 標題')
                            ->maxLength(255)
                            ->helperText('建議長度：50-60 字元')
                            ->placeholder('如果未填寫，將使用標題作為 Meta 標題')
                            ->columnSpanFull(),
                            
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta 描述')
                            ->maxLength(255)
                            ->helperText('建議長度：150-160 字元')
                            ->placeholder('如果未填寫，將使用描述的前 160 字元')
                            ->columnSpanFull(),
                            
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Meta 關鍵字')
                            ->maxLength(255)
                            ->helperText('請用逗號分隔關鍵字')
                            ->placeholder('例如：教育服務,學校課程,教學培訓')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->description('設定網頁的 SEO 相關資訊，有助於提升搜尋引擎排名')
                    ->icon('heroicon-o-magnifying-glass'),
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
                    
                Tables\Columns\TextColumn::make('order')
                    ->label('排序')
                    ->sortable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('狀態')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('狀態')
                    ->trueLabel('啟用')
                    ->falseLabel('停用')
                    ->placeholder('全部'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
} 