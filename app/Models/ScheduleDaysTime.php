<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDaysTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'slot_time',
    ];
}
