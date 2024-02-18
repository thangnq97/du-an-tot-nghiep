<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_interior extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'interior_id', 'quantity', 'status'];
}
