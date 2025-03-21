<?php

namespace App\Filament\Resources\SchoolHighlightResource\Pages;

use App\Filament\Resources\SchoolHighlightResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolHighlight extends CreateRecord
{
    protected static string $resource = SchoolHighlightResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 