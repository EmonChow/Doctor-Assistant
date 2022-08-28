<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use App\Models\ScheduleDay;


class Schedule extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'title',
        'address',
        'contact_person',
        'phone',
        'email',
        'user_id'
    ];

    public function scheduleDays(): HasMany
    {
        return $this->hasMany(ScheduleDay::class);
    }

    public function scheduleDaysTimes(): HasMany
    {
        return $this->hasMany(ScheduleDay::class)->with('times');
    }

}
