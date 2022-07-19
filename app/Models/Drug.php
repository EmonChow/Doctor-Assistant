<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Drug extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'trade_name',
        'generic_name',
        'note',
        'additional_advice',
        'warning',
        'side_effect',
    ];
}
