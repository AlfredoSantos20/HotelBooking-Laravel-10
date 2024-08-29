<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'bookings';

    function customer(){
        return $this->belongsTo(User::class);
    }

    function room(){
        return $this->belongsTo(Room::class);
    }
}
