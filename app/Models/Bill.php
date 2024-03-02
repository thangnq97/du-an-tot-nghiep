<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';


    protected $fillable = ['room_id', 'total_price', 'remaining_amount', 'total_price_service', 'note'];

    public function room(){
        return $this->belongsTo(\App\Models\Room::class);
    }
    public function water(){
        return $this->belongsTo(Water_usage::class);
    }
    public function electricity(){
        return $this->belongsTo(Electricity_usage::class);
    }
}
