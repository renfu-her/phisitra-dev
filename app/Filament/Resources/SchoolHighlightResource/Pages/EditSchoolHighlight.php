<?php

namespace App\Filament\Resources\SchoolHighlightResource\Pages;

use App\Filament\Resources\SchoolHighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolHighlight extends EditRecord
{
    protected static string $resource = SchoolHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 