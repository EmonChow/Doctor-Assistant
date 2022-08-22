<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;


class Doctor extends Model
{
    use HasFactory;

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
}
