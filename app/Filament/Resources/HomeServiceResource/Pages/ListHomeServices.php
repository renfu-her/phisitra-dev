<?php

namespace App\Filament\Resources\HomeServiceResource\Pages;

use App\Filament\Resources\HomeServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListHomeServices extends ListRecords
{
    protected static string $resource = HomeServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('新增服務')
                ->modalHeading('新增首頁服務')
                ->modalSubmitActionLabel('建立服務')
                ->modalCancelActionLabel('取消'),
        ];
    }

    public function getTabs(): array
    {
        return [
            '全部' => Tab::make()
                ->icon('heroicon-o-list-bullet'),
            '啟用中' => Tab::make()
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true)),
            '未啟用' => Tab::make()
                ->icon('heroicon-o-x-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false)),
        ];
    }
}
