<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_information extends Model
{
    use HasFactory;
    
    protected $table = 'user_information';

    protected $fillable = ['user_id',  'sex', 'year',  'license_plates',  'note'];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
