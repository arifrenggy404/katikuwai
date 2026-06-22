<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!\App\Models\User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Clean up settings and seed Desa Katiku Wai
        \App\Models\Setting::query()->delete();
        \App\Models\Setting::create([
            'desa_name' => 'Desa Katiku Wai',
            'desa_email' => 'info@katikuwai.desa.id',
            'desa_phone' => '0821-3456-7890',
            'desa_address' => 'Jl. Lintas Sumba, Desa Katiku Wai, Kecamatan Matawai La Pawu, Kabupaten Sumba Timur, Nusa Tenggara Timur (87174)',
            'desa_maps_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15739.0232490059!2d120.2113264478148!3d-10.075678900452336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c4cc03af87c1261%3A0x2db43e7bbbf33d96!2sKatiku%20Wai%2C%20Matawai%20La%20Pawu%2C%20East%20Sumba%20Regency%2C%20East%20Nusa%20Tenggara!5e0!3m2!1sen!2sid!4v1759804386834!5m2!1sen!2sid',
            'desa_vision' => 'Terwujudnya Desa Katiku Wai yang Sejahtera, Berbudaya, dan Mandiri Melalui Pemanfaatan Potensi Lokal dan Infrastruktur yang Berkelanjutan.',
            'desa_mission' => "1. Meningkatkan kualitas pelayanan publik dan tata kelola desa yang bersih serta transparan.\n2. Mengembangkan pertanian dan peternakan lokal yang berkelanjutan.\n3. Melestarikan nilai-nilai adat, budaya, dan kearifan lokal Sumba.\n4. Meningkatkan akses kesehatan dan pendidikan bagi masyarakat pedalaman.",
            'desa_about' => 'Desa Katiku Wai (Katikuwai) adalah sebuah desa yang terletak di Kecamatan Matawai La Pawu, Kabupaten Sumba Timur, Provinsi Nusa Tenggara Timur. Terletak di daratan tinggi Pulau Sumba, desa ini berada di dekat kawasan konservasi Gunung Wanggameti (Taman Nasional Laiwangi Wanggameti) yang kaya akan keanekaragaman hayati.',
            'desa_history' => 'Desa Katiku Wai dibentuk sebagai bagian dari pengembangan wilayah administratif di Sumba Timur untuk mendekatkan akses pelayanan bagi warga pedalaman. Masyarakatnya didominasi oleh suku asli Sumba yang mempertahankan adat istiadat leluhur mereka.',
            'desa_origin' => 'Nama "Katiku Wai" berasal dari bahasa lokal Sumba yang berarti "Kepala Air" atau "Mata Air", melambangkan kedudukan desa sebagai daerah tangkapan air penting yang menghidupi wilayah di sekitarnya.',
            'desa_area' => '159.1 Km²',
            'desa_area_ha' => '15.910 Ha',
            'desa_population' => '1.536 Jiwa',
            'desa_families' => '384 KK',
            'desa_rt' => '8',
            'desa_dusun' => '3',
            'bound_north' => 'Kecamatan Pandawai',
            'bound_east' => 'Desa Katiku Luku',
            'bound_south' => 'Desa Nggoni (Kecamatan Karera)',
            'bound_west' => 'Desa Katiku Tana',
        ]);

        // Clean up village officials and seed with Sumba names
        \App\Models\VillageOfficial::query()->delete();
        $officials = [
            ['name' => 'UMBU NDAHA', 'position' => 'Kepala Desa', 'order' => 1, 'group' => 'pemerintah'],
            ['name' => 'RAMBU YAKU', 'position' => 'Sekretaris Desa', 'order' => 2, 'group' => 'pemerintah'],
            ['name' => 'UMBU NAY', 'position' => 'Kepala Urusan Keuangan', 'order' => 3, 'group' => 'pemerintah'],
            ['name' => 'RAMBU HAMU', 'position' => 'Kepala Urusan Perencanaan', 'order' => 4, 'group' => 'pemerintah'],
            ['name' => 'UMBU KABUBU', 'position' => 'Kepala Urusan Tata Usaha', 'order' => 5, 'group' => 'pemerintah'],
            ['name' => 'RAMBU ANA', 'position' => 'Kepala Seksi Pemerintahan', 'order' => 6, 'group' => 'pemerintah'],
            ['name' => 'UMBU NDILU', 'position' => 'Kepala Seksi Kesejahteraan', 'order' => 7, 'group' => 'pemerintah'],
            ['name' => 'UMBU LANDU', 'position' => 'Kepala Seksi Pelayanan', 'order' => 8, 'group' => 'pemerintah'],
            ['name' => 'UMBU HARU', 'position' => 'Ketua BPD', 'order' => 9, 'group' => 'bpd'],
            ['name' => 'UMBU REKU', 'position' => 'Ketua Dusun I', 'order' => 10, 'group' => 'dusun'],
            ['name' => 'UMBU DETA', 'position' => 'Ketua Dusun II', 'order' => 11, 'group' => 'dusun'],
        ];

        foreach ($officials as $official) {
            \App\Models\VillageOfficial::create([
                'name' => $official['name'],
                'position' => $official['position'],
                'order' => $official['order'],
                'group' => $official['group'],
                'photo' => null,
            ]);
        }
    }
}
