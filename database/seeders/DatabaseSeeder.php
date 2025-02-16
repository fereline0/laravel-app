<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ServerMetricsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
            ServerMetricsSeeder::class,
        ]);
    }
}
