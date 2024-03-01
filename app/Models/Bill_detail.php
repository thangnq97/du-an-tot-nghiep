<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    use HasFactory;

    protected $table = 'bill_detail';

    protected $fillable = ['bill_id', 'email', 'name', 'room_name', 'room_price', 'date_start', 'date_end', 'pre_water', 'current_water', 'water_price', 'pre_electricity', 'current_electricity', 'electricity_price', 'total_price_service'];
    
}