<?php

namespace App\Filament\Resources\SchoolHighlightResource\Pages;

use App\Filament\Resources\SchoolHighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolHighlights extends ListRecords
{
    protected static string $resource = SchoolHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 