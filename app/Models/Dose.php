<?php

namespace App\Models;

use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dose extends Model
{
    use HasFactory, HasFilter;


    protected $fillable = [
        'dose',
        'status',

    ];
}
