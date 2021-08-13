<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    use HasFactory;

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function price()
    {
        return $this->hasMany(Price::class);
    }
}
