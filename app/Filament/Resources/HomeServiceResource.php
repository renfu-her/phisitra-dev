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
use Illuminate\Support\HtmlString;

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
                    ->helperText(new HtmlString('
                        使用 FontAwesome 6 圖標，只可以用<span class="text-red-500">英文</span>查詢<br>例如：fa-user-graduate<br>
                        <div class="mt-1">
                            <a href="https://fontawesome.com/search?o=r&m=free" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="text-primary-600 hover:text-primary-500">
                                點擊這裡查看所有可用的免費圖標 <i class="fas fa-external-link-alt text-xs ml-1"></i>
                            </a>
                        </div>
                        <div class="mt-1 text-gray-500">
                            常用圖標代碼：
                            <ul class="list-disc list-inside mt-1 space-y-1">
                                <li><code>fa-user-graduate</code> <i class="fa-solid fa-user-graduate"></i> - 學生管理</li>
                                <li><code>fa-book</code> <i class="fa-solid fa-book"></i> - 課程管理</li>
                                <li><code>fa-hands-helping</code> <i class="fa-solid fa-hands-helping"></i> - 生活輔導</li>
                                <li><code>fa-globe</code> <i class="fa-solid fa-globe"></i> - 國際交流</li>
                            </ul>
                        </div>
                    '))
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
