<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Drug;
use App\Models\DrugType;

class DrugDose extends Model
{
    use HasFactory;

    public function drug() {
        return $this->hasMany(Drug::class);
    }

    public function drugType() {
        return $this->hasMany(DrugType::class);
    }
}
