<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Filament\Resources\ContactInfoResource\RelationManagers;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = '網站管理';
    protected static ?string $navigationLabel = '諮詢管理';
    protected static ?string $modelLabel = '諮詢資料';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('諮詢資料')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('姓名')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('電子郵件')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('電話')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('subject')
                            ->label('主旨')
                            ->required(),
                        Forms\Components\Textarea::make('message')
                            ->label('訊息內容')
                            ->required()
                            ->rows(4),
                        Forms\Components\Select::make('status')
                            ->label('狀態')
                            ->options([
                                'pending' => '待處理',
                                'processing' => '處理中',
                                'completed' => '已完成',
                            ])
                            ->default('pending')
                            ->required(),
                        Forms\Components\Textarea::make('reply')
                            ->label('回覆內容')
                            ->rows(4),
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->label('回覆時間'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('電子郵件')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('電話'),
                Tables\Columns\TextColumn::make('subject')
                    ->label('主旨')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('狀態')
                    ->options([
                        'pending' => '待處理',
                        'processing' => '處理中',
                        'completed' => '已完成',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('狀態')
                    ->options([
                        'pending' => '待處理',
                        'processing' => '處理中',
                        'completed' => '已完成',
                    ]),
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
            'index' => Pages\ListContactInfos::route('/'),
            'create' => Pages\CreateContactInfo::route('/create'),
            'edit' => Pages\EditContactInfo::route('/{record}/edit'),
        ];
    }
}
