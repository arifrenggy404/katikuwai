<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterRequest extends Model
{
    protected $fillable = [
        'ticket_number',
        'name',
        'nik',
        'phone',
        'letter_type',
        'purpose',
        'status',
        'admin_note',
        'attachment',
    ];
}
