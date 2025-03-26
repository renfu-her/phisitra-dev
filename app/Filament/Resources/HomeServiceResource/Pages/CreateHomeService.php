<?php

namespace App\Filament\Resources\HomeServiceResource\Pages;

use App\Filament\Resources\HomeServiceResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateHomeService extends CreateRecord
{
    protected static string $resource = HomeServiceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('首頁服務已建立')
            ->body('新的首頁服務已成功建立。');
    }
}
