<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water_usage extends Model
{
    use HasFactory;

    protected $fillable = ['room_id','pre_water', 'current_water', 'used_water'];
}
