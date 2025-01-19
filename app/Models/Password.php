<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source',
        'value',
        'privacy',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
