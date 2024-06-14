<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $primaryKey = 'city_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function employees() {
        return $this->hasMany(Employee::class, 'city_id');
    }
}
