<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function card_type()
    {
        return $this->belongsTo(CardType::class);
    }

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
