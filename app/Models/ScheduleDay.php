<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ScheduleDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'time_slot',
        'schedule_id'
    ];

    public function times(): HasMany
    {
        return $this->hasMany(ScheduleDayTime::class);
    }

}
