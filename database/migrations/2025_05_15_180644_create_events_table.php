<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('artist');
        $table->string('venue');
        $table->string('city');
        $table->dateTime('date');
        $table->string('location');  // <- This might be missing
        $table->decimal('price', 8, 2);
        $table->string('status')->default('upcoming'); // upcoming, cancelled, finished
        $table->string('category')->nullable(); // pop, rock, etc.
        $table->text('description')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
