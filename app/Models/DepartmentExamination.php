<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\DepartmentExaminationField;

class DepartmentExamination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function departmentExaminationField(): HasMany
    {
        return $this->hasMany(DepartmentExaminationField::class);
    }
}
