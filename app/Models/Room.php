<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Room extends Model
{
    use HasFactory;

    protected $fillable = ['occupancy', 'room_type', 'image','status'];

    public function RoomType(){
        return $this->belongsTo(RoomType::class,'room_type');
    }

    public function bookings()
{
    return $this->hasMany(Booking::class, 'room_id');
}

//Added Counting the most booked room type
public static function mostBooked($limit = 3)
{
    return RoomType::withCount(['rooms as bookings_count' => function ($query) {
        $query->has('bookings');
    }])
    ->having('bookings_count', '>', 0) // Only include room types with more than 1 booking
    ->orderBy('bookings_count', 'desc')
    ->take($limit)
    ->get();
}


}
