<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function RoomType(){
        return $this->belongsTo(RoomType::class,'room_type');
    }

    public function bookings()
{
    return $this->hasMany(Booking::class, 'room_id');
}
}
