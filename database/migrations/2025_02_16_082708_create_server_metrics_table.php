<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerMetricsTable extends Migration
{
    public function up()
    {
        Schema::create('server_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('server_name');
            $table->float('cpu_usage');
            $table->float('memory_usage');
            $table->float('disk_usage');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('server_metrics');
    }
}
