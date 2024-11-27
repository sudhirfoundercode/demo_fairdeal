<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jackpot extends Model
{
    use HasFactory;

    protected $fillable = ['jackpot_duration', 'jackpot_count', 'jackpot_left', 'active_jackpot'];

    protected $casts = [
        'active_jackpot' => 'array', // Handle JSON data
    ];
}
