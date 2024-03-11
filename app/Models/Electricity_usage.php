<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity_usage extends Model
{
    use HasFactory;

    protected $table = 'electricity_usage';

    protected $fillable = ['room_id','pre_electricity', 'current_electricity', 'used_electricity', 'date_time', 'service_id'];

    public function room(){
        return $this->belongsTo(\App\Models\Room::class);
    }
    public function service(){
        return $this->belongsTo(\App\Models\Service::class);
    }
}
