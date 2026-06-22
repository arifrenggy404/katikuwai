<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'desa_name',
        'desa_email',
        'desa_phone',
        'desa_address',
        'desa_maps_link',
        'desa_vision',
        'desa_mission',
        'desa_logo',
        'desa_about',
        'desa_history',
        'desa_origin',
        'desa_area',
        'desa_area_ha',
        'desa_population',
        'desa_families',
        'desa_rt',
        'desa_dusun',
        'bound_north',
        'bound_east',
        'bound_south',
        'bound_west',
        'desa_history_image',
    ];
}
