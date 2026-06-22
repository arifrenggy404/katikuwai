<?php

namespace App\Filament\Resources\Demographics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class DemographicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pekerjaan' => 'primary',
                        'pendidikan' => 'success',
                        'usia' => 'warning',
                        'gender' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pekerjaan' => 'Pekerjaan',
                        'pendidikan' => 'Pendidikan',
                        'usia' => 'Kelompok Usia',
                        'gender' => 'Jenis Kelamin',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('label')
                    ->label('Label/Keterangan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Jumlah Penduduk')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('category', 'asc')
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
