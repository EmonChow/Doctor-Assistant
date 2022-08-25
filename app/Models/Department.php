<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class Department extends Model
{
    use HasFactory;
    use HasFilter;

    protected $fillable = [
        'name',
        'description',
    ];

    public function departmentExamination(): HasMany
    {
        return $this->hasMany(DepartmentExamination::class)->with('departmentExaminationField');
    }

}
