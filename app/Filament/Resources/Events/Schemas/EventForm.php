<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Kegiatan')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Deskripsi Kegiatan')
                    ->rows(4),
                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
                TimePicker::make('time')
                    ->label('Waktu'),
                TextInput::make('location')
                    ->label('Tempat/Lokasi')
                    ->maxLength(255),
            ]);
    }
}
