<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtensionContract extends Model
{
    use HasFactory;

    protected $table = 'extension_contracts';

    protected $fillable = ['month_quantity', 'started_at', 'description', 'contract_id'];
}
