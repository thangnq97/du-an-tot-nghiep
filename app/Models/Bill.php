<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['name','room_id', 'total_price', 'remaining_amount', 'total_price_service'];

    public function room(){
        return $this->belongsTo(\App\Models\Room::class);
    }
    public function payment(){
        return $this->belongsTo(\App\Models\Payment_method::class);
    }
}
