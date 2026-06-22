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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('desa_name')->default('Desa Air Senggeris');
            $table->string('desa_email')->default('info.airsenggeris@gmail.com');
            $table->string('desa_phone')->nullable();
            $table->text('desa_address')->nullable();
            $table->text('desa_maps_link')->nullable();
            $table->text('desa_vision')->nullable();
            $table->text('desa_mission')->nullable();
            $table->string('desa_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
