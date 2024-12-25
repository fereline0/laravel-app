<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('image')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->foreignId('publisher_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
