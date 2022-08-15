<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use HasFilter;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'schedule_day_id',
        'schedule_day_time_id',
    ];
}
