<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
     * @return MorphTo
     */
    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'profile');
    }
}
