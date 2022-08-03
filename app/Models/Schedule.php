<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use App\Models\SchedulesDays;


class Schedule extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'title',
        'address',
        'contact_person',
        'phone',
        'email'
    ];
    public function schedules_days(){
       return $this->hasMany(SchedulesDays::class);
    }

}
