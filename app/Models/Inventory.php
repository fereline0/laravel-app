<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'quantity',
        'cabinet_id',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class);
    }
}
