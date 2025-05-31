<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
                  
            $table->foreignId('event_id')
                  ->constrained()
                  ->onDelete('cascade');
                  
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
            
            // Prevent duplicate items
            $table->unique(['user_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};