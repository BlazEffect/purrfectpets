<?php

namespace App\Filament\Resources\CatalogProductPropertyResource\Pages;

use App\Filament\Resources\CatalogProductPropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatalogProductProperties extends ListRecords
{
    protected static string $resource = CatalogProductPropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
