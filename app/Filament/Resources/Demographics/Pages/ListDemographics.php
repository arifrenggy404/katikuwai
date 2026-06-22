<?php

namespace App\Filament\Resources\Demographics\Pages;

use App\Filament\Resources\Demographics\DemographicResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemographics extends ListRecords
{
    protected static string $resource = DemographicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
