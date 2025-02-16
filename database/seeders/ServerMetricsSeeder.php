<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServerMetric;
use Carbon\Carbon;

class ServerMetricsSeeder extends Seeder
{
    public function run()
    {
        $servers = [
            'web-server-01',
            'db-server-01',
            'cache-server-01',
            'app-server-01',
            'file-server-01',
        ];

        foreach ($servers as $server) {
            for ($hour = 0; $hour < 24; $hour++) {
                ServerMetric::create([
                    'server_name' => $server,
                    'cpu_usage' => rand(0, 1),
                    'memory_usage' => rand(0, 1),
                    'disk_usage' => rand(0, 1),
                    'created_at' => Carbon::now()->subHours($hour),
                ]);
            }
        }
    }
}
