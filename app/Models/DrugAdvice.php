<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class DrugAdvice extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = [
        'advice',
        'status',

    ];
}
