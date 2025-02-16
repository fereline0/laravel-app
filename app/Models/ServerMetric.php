<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerMetric extends Model
{
    protected $fillable = [
        'server_name',
        'cpu_usage',
        'memory_usage',
        'disk_usage',
    ];
}
