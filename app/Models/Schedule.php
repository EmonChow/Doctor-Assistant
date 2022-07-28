<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class Schedule extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'title',
        'address',
        'contact_person',
        'phone',
        'email',
        'email',
        'user_id'
    ];
}
