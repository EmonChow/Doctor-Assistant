<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;
    use HasFilter;

    protected $fillable = [
        'title',
        'description',
        'department_id'
    ];

    /**
     * Polymorphic Relation With User
     * @return MorphOne
     */
    public function user():MorphOne
    {
         return $this->morphOne(User::class, 'profileable');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
