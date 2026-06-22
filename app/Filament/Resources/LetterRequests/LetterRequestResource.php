<?php

namespace App\Filament\Resources\LetterRequests;

use App\Filament\Resources\LetterRequests\Pages\CreateLetterRequest;
use App\Filament\Resources\LetterRequests\Pages\EditLetterRequest;
use App\Filament\Resources\LetterRequests\Pages\ListLetterRequests;
use App\Filament\Resources\LetterRequests\Schemas\LetterRequestForm;
use App\Filament\Resources\LetterRequests\Tables\LetterRequestsTable;
use App\Models\LetterRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LetterRequestResource extends Resource
{
    protected static ?string $model = LetterRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LetterRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LetterRequestsTable::configure($table);
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
            'index' => ListLetterRequests::route('/'),
            'create' => CreateLetterRequest::route('/create'),
            'edit' => EditLetterRequest::route('/{record}/edit'),
        ];
    }
}
