<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_interior extends Model
{
    use HasFactory;

    protected $table = 'room_interior';

    protected $fillable = ['room_id', 'interior_id', 'quantity', 'status',  'price',  'description'];

    public function interior()
    {
        return $this->belongsTo(Interior::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
