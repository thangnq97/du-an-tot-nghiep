<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_service extends Model
{
    use HasFactory;

    protected $table = 'room_service';

    protected $fillable = ['room_id', 'service_id'];
}