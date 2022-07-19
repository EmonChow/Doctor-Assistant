<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Drug;

class DrugType extends Model
{
    use HasFactory;


    protected $table = 'drug_types';

    protected $guarded = [];
        
      
  
  
    public function drug() {
        return $this->hasMany(Drug::class, 'drug_id', 'id');
    }

}
