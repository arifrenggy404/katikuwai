<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(255),
                Textarea::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->rows(5),
                TextInput::make('order')
                    ->label('Urutan Tampilan')
                    ->numeric()
                    ->default(1)
                    ->required(),
            ]);
    }
}
