<?php

namespace App\Filament\Resources\LetterRequests\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class LetterRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ticket_number')
                    ->label('Nomor Tiket')
                    ->disabled()
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Lengkap Pemohon')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nik')
                    ->label('NIK Pemohon')
                    ->required()
                    ->length(16),
                TextInput::make('phone')
                    ->label('Nomor Telepon/WA')
                    ->required(),
                Select::make('letter_type')
                    ->label('Jenis Surat')
                    ->options([
                        'Surat Keterangan Domisili' => 'Surat Keterangan Domisili',
                        'Surat Keterangan Tidak Mampu' => 'Surat Keterangan Tidak Mampu (SKTM)',
                        'Surat Keterangan Usaha' => 'Surat Keterangan Usaha (SKU)',
                        'Surat Keterangan Kematian' => 'Surat Keterangan Kematian',
                    ])
                    ->required(),
                Textarea::make('purpose')
                    ->label('Keperluan / Tujuan')
                    ->required()
                    ->rows(3),
                Select::make('status')
                    ->label('Status Pengajuan')
                    ->options([
                        'pending' => 'Menunggu Review (Pending)',
                        'approved' => 'Disetujui & Siap Diambil (Approved)',
                        'rejected' => 'Ditolak (Rejected)',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('admin_note')
                    ->label('Catatan Admin')
                    ->placeholder('Misal: Berkas sudah disetujui, silakan ambil di kantor desa membawa dokumen asli.')
                    ->rows(3),
                FileUpload::make('attachment')
                    ->label('Dokumen Pendukung (KTP/KK)')
                    ->directory('letter_attachments')
                    ->disk('public')
                    ->disabled(),
            ]);
    }
}
