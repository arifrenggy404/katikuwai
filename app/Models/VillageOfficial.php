<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'order',
        'group',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if (is_string($value)) {
                    $model->{$key} = trim($value);
                }
            }
        });
    }
}
