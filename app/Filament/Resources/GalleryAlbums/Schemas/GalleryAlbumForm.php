<?php

namespace App\Filament\Resources\GalleryAlbums\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

class GalleryAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Album')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Deskripsi Album')
                    ->rows(3),
                FileUpload::make('cover_image')
                    ->label('Foto Sampul Album')
                    ->directory('gallery/covers')
                    ->disk('public')
                    ->image()
                    ->required(),
                
                Repeater::make('photos')
                    ->relationship('photos')
                    ->label('Foto-Foto dalam Album')
                    ->components([
                        FileUpload::make('image')
                            ->label('Foto')
                            ->directory('gallery/photos')
                            ->disk('public')
                            ->image()
                            ->required(),
                        TextInput::make('caption')
                            ->label('Keterangan Foto / Caption')
                            ->maxLength(255),
                    ])
                    ->grid(2)
                    ->defaultItems(0)
                    ->collapsible()
                    ->helperText('Unggah foto-foto kegiatan yang tergabung dalam album ini.'),
            ]);
    }
}
