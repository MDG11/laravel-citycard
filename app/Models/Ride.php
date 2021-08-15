<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
