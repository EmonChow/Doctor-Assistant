<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentExaminationField extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'field_type',
        'department_examination_id'
    ];
}
