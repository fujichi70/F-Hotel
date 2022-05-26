<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'room_id',
        'lastname',
        'firstname',
        'email',
        'address',
        'tel',
        'people',
        'men',
        'women',
        'arrival',
        'departure',
        'checkin_time',
    ];

}
