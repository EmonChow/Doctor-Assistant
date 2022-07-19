<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Drug;
use App\Models\DrugType;

class DrugDose extends Model
{
    use HasFactory;

    
    protected $table = 'drug_doses';

    protected $guarded = [];
  
    public function drug() {
        return $this->hasMany(Drug::class, 'drug_id', 'id');
    }

    public function drugType() {
        return $this->belongsTo(DrugType::class, 'drug_type_id', 'id');
    }
}
