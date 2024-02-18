<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity_usage extends Model
{
    use HasFactory;

    protected $fillable = ['room_id','pre_electricity', 'current_electricity', 'used_electricity'];
}
