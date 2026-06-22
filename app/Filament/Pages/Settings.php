<?php

namespace App\Filament\Pages;

use App\Models\Setting as SettingModel;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Actions\Action;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected string $view = 'filament.pages.settings';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $title = 'Pengaturan Desa';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = SettingModel::first();
        
        if ($setting) {
            $this->form->fill($setting->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->components([
                Section::make('Informasi Umum Desa')
                    ->components([
                        TextInput::make('desa_name')
                            ->label('Nama Desa')
                            ->required(),
                        TextInput::make('desa_email')
                            ->label('Email Desa (untuk Notifikasi Kontak & Pengaduan)')
                            ->email()
                            ->required(),
                        TextInput::make('desa_phone')
                            ->label('Telepon Desa')
                            ->required(),
                        FileUpload::make('desa_logo')
                            ->label('Logo Desa')
                            ->directory('settings')
                            ->image()
                            ->disk('public'),
                    ])->columns(2),

                Section::make('Tentang & Sejarah Desa')
                    ->components([
                        Textarea::make('desa_about')
                            ->label('Tentang Desa')
                            ->helperText('Penjelasan singkat yang akan muncul di Beranda utama.')
                            ->rows(3),
                        Textarea::make('desa_history')
                            ->label('Sejarah Desa')
                            ->helperText('Penjelasan sejarah pembentukan desa untuk halaman Profil.')
                            ->rows(4),
                        Textarea::make('desa_origin')
                            ->label('Asal-usul Nama Desa')
                            ->helperText('Penjelasan mengenai sejarah asal-usul nama desa.')
                            ->rows(3),
                        FileUpload::make('desa_history_image')
                            ->label('Foto Sejarah Desa')
                            ->directory('settings')
                            ->image()
                            ->disk('public'),
                    ]),

                Section::make('Visi & Misi')
                    ->components([
                        Textarea::make('desa_vision')
                            ->label('Visi Desa')
                            ->rows(3),
                        Textarea::make('desa_mission')
                            ->label('Misi Desa')
                            ->rows(5)
                            ->helperText('Pisahkan setiap poin misi dengan baris baru.'),
                    ]),

                Section::make('Data Kependudukan & Geografis')
                    ->components([
                        TextInput::make('desa_area')
                            ->label('Luas Wilayah (Km²)')
                            ->default('12.5 Km²'),
                        TextInput::make('desa_area_ha')
                            ->label('Luas Wilayah (Ha)')
                            ->default('662,00 Ha'),
                        TextInput::make('desa_population')
                            ->label('Jumlah Penduduk')
                            ->default('805 Jiwa'),
                        TextInput::make('desa_families')
                            ->label('Jumlah Kepala Keluarga (KK)')
                            ->default('252 KK'),
                        TextInput::make('desa_rt')
                            ->label('Jumlah RT')
                            ->default('6'),
                        TextInput::make('desa_dusun')
                            ->label('Jumlah Dusun')
                            ->default('2'),
                    ])->columns(3),

                Section::make('Batas Wilayah Desa')
                    ->components([
                        TextInput::make('bound_north')
                            ->label('Batas Utara'),
                        TextInput::make('bound_east')
                            ->label('Batas Timur'),
                        TextInput::make('bound_south')
                            ->label('Batas Selatan'),
                        TextInput::make('bound_west')
                            ->label('Batas Barat'),
                    ])->columns(2),

                Section::make('Peta & Kontak')
                    ->components([
                        TextInput::make('desa_address')
                            ->label('Alamat Lengkap Kantor Desa')
                            ->required(),
                        TextInput::make('desa_maps_link')
                            ->label('Link Google Maps (Iframe/URL Map)')
                            ->helperText('Masukkan URL peta kantor desa dari Google Maps untuk ditampilkan di halaman kontak.'),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        $setting = SettingModel::first();
        if ($setting) {
            $setting->update($data);
        } else {
            SettingModel::create($data);
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
