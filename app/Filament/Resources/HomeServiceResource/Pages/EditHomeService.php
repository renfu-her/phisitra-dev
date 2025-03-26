<?php

namespace App\Filament\Resources\HomeServiceResource\Pages;

use App\Filament\Resources\HomeServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditHomeService extends EditRecord
{
    protected static string $resource = HomeServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('刪除服務')
                ->modalHeading('刪除首頁服務')
                ->modalDescription('確定要刪除這個首頁服務嗎？此操作無法復原。')
                ->modalSubmitActionLabel('確定刪除')
                ->modalCancelActionLabel('取消'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('首頁服務已更新')
            ->body('首頁服務資料已成功更新。');
    }
}
