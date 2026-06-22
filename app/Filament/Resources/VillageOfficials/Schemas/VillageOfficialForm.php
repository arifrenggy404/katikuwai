<?php

namespace App\Filament\Resources\VillageOfficials\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class VillageOfficialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Aparat')
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
                Select::make('group')
                    ->label('Kelompok Jabatan')
                    ->options([
                        'pemerintah' => 'Pemerintah Desa',
                        'bpd' => 'Badan Permusyawaratan Desa (BPD)',
                        'dusun' => 'Kepala Dusun / RW / RT',
                    ])
                    ->default('pemerintah')
                    ->required(),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(1)
                    ->required()
                    ->helperText('Menentukan urutan penampilan bagan organisasi (semakin kecil nomor, semakin atas).'),
                FileUpload::make('photo')
                    ->label('Foto Aparat')
                    ->directory('officials')
                    ->disk('public')
                    ->image()
                    ->helperText('Unggah foto dengan rasio aspek persegi / lingkaran.'),
            ]);
    }
}
