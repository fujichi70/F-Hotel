<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function Reserve_day()
    {
        return $this->hasMany(Reserve_day::class, 'room_id', 'room_id');
    }
}


