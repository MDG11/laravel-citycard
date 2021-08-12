<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Card extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['balance', 'card_code', 'user_id', 'card_type_id'];

    protected $hidden = ['remember_token'];
}
