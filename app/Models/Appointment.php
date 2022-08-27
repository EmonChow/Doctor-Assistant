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
        'doctor_id',
        'patient_id',
        'appointment_date',
        'schedule_day_time_id',
    ];
}
