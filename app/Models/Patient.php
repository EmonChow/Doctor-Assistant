<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class Patient extends Model
{
    use HasFactory;
    use HasFilter;

    protected $fillable = [
        'height',
        'weight',
        'birth_date'
    ];

    public function user():MorphOne
    {
         return $this->morphOne(User::class, 'profileable');
    }
}
