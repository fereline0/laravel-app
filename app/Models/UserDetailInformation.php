<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetailInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'about',
        'gender',
        'birthday',
        'phone_number',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
