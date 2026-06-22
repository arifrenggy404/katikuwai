<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('desa_about')->nullable();
            $table->text('desa_history')->nullable();
            $table->text('desa_origin')->nullable();
            $table->string('desa_area')->default('12.5 Km²');
            $table->string('desa_area_ha')->default('662,00 Ha');
            $table->string('desa_population')->default('805 Jiwa');
            $table->string('desa_families')->default('252 KK');
            $table->string('desa_rt')->default('6');
            $table->string('desa_dusun')->default('2');
            $table->string('bound_north')->default('Desa Lubuk Lancang');
            $table->string('bound_east')->default('Desa Sukaraja');
            $table->string('bound_south')->default('Desa Talang Ipuh');
            $table->string('bound_west')->default('Desa Durian Daun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'desa_about', 'desa_history', 'desa_origin',
                'desa_area', 'desa_area_ha', 'desa_population', 'desa_families',
                'desa_rt', 'desa_dusun',
                'bound_north', 'bound_east', 'bound_south', 'bound_west'
            ]);
        });
    }
};
