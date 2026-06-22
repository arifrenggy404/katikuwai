<?php

namespace App\Filament\Resources\Budgets\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class BudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('year')
                    ->label('Tahun Anggaran')
                    ->numeric()
                    ->default(date('Y'))
                    ->required(),
                Select::make('type')
                    ->label('Jenis Anggaran')
                    ->options([
                        'pendapatan' => 'Pendapatan Desa',
                        'belanja' => 'Belanja Desa',
                        'pembiayaan' => 'Pembiayaan Desa',
                    ])
                    ->required(),
                TextInput::make('category')
                    ->label('Kategori / Uraian')
                    ->placeholder('Misal: Dana Desa (DD), Bidang Pembangunan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('amount')
                    ->label('Jumlah (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }
}
