<?php

namespace App\Filament\Resources\Demographics;

use App\Filament\Resources\Demographics\Pages\CreateDemographic;
use App\Filament\Resources\Demographics\Pages\EditDemographic;
use App\Filament\Resources\Demographics\Pages\ListDemographics;
use App\Filament\Resources\Demographics\Schemas\DemographicForm;
use App\Filament\Resources\Demographics\Tables\DemographicsTable;
use App\Models\Demographic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DemographicResource extends Resource
{
    protected static ?string $model = Demographic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DemographicForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemographicsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDemographics::route('/'),
            'create' => CreateDemographic::route('/create'),
            'edit' => EditDemographic::route('/{record}/edit'),
        ];
    }
}
