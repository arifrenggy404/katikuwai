<?php

namespace App\Filament\Resources\Demographics\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class DemographicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->label('Kategori Demografi')
                    ->options([
                        'pekerjaan' => 'Pekerjaan',
                        'pendidikan' => 'Pendidikan',
                        'usia' => 'Kelompok Usia',
                        'gender' => 'Jenis Kelamin',
                    ])
                    ->required(),
                TextInput::make('label')
                    ->label('Label/Keterangan')
                    ->placeholder('Misal: Petani, SMA, Laki-laki')
                    ->required()
                    ->maxLength(255),
                TextInput::make('value')
                    ->label('Jumlah Penduduk')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}
