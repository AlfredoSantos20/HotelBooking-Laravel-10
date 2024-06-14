<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Region extends Model
{
    use HasFactory;

    protected $primaryKey = 'region_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function employees() {
        return $this->hasMany(Employee::class, 'region_id');
    }
}
