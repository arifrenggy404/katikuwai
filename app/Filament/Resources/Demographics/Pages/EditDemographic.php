<?php

namespace App\Filament\Resources\Demographics\Pages;

use App\Filament\Resources\Demographics\DemographicResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDemographic extends EditRecord
{
    protected static string $resource = DemographicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
