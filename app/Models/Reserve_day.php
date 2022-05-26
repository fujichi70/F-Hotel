<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve_day extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'room_id',
        'day'
    ];


}
