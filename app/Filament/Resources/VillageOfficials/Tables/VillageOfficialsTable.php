<?php

namespace App\Filament\Resources\VillageOfficials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class VillageOfficialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('group')
                    ->label('Kelompok')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pemerintah' => 'primary',
                        'bpd' => 'warning',
                        'dusun' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pemerintah' => 'Pemerintah Desa',
                        'bpd' => 'BPD',
                        'dusun' => 'Kepala Dusun/RW/RT',
                        default => $state,
                    }),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
