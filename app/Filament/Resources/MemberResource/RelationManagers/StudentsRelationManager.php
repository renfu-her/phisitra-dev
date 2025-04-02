<?php

namespace App\Filament\Resources\MemberResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $recordTitleAttribute = 'name_en';

    protected static ?string $navigationGroup = '學生管理';

    protected static ?string $modelLabel = '學生列表';

    protected static ?string $title = '學生列表';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_en')
                    ->label('英文姓名')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_zh')
                    ->label('中文姓名')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('照片')
                    ->circular(),
                Tables\Columns\TextColumn::make('name_zh')
                    ->label('中文姓名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('英文姓名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('性別')
                    ->formatStateUsing(fn ($state) => $state === 'male' ? '男生' : '女生'),
                Tables\Columns\ToggleColumn::make('student_members.status')
                    ->label('審核狀態')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name_en', 'name_zh'])
                    ->after(function ($data, $record) {
                        // 設置初始狀態為待審核
                        $record->studentMembers()->updateExistingPivot($record->id, [
                            'status' => false
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('解除附加')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('批量解除附加')
                        ->color('danger'),
                ]),
            ]);
    }
} 