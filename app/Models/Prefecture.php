<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Board;

class Prefecture extends Model
{
    use HasFactory;

    //relation
    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}
