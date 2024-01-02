<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;

class Board extends Model
{
    use HasFactory;

    //relation
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
}
