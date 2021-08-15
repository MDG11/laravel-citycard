<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['licence_plate_number','city_id','vehicle_type_id'];
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
