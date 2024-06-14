<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function province(){
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }
}
