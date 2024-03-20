<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water_usage extends Model
{
    use HasFactory;


    protected $fillable = ['room_id','pre_water', 'current_water', 'used_water','date_time', 'service_id'];
    protected $table = 'water_usage';
    public function room(){
        return $this->belongsTo(\App\Models\Room::class);
    }
    public function service(){
        return $this->belongsTo(\App\Models\Service::class);
    }
}