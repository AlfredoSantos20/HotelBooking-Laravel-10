<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
class RoomType extends Model
{
    use HasFactory;

public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type');
    }

//Calculate Discounted Price
public function discountedPrice()
{
    if ($this->discount > 0 && $this->discount <= 100) {
        return $this->price - ($this->price * ($this->discount / 100));
    }
    return $this->price;
}

}
