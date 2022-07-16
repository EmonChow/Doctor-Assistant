<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{

    protected static function boot()
    {
        parent::boot();

        self::creating(function (FileManager $file_manager) {
            $file_manager->user_id = auth()->id;
        });
    }
}
