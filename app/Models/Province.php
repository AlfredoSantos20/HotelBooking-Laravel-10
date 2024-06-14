<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $primaryKey = 'province_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function employees() {
        return $this->hasMany(Employee::class, 'province_id');
    }
}
