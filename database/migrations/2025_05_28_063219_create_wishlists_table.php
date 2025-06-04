<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Wishlist;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    if (!Schema::hasColumn('users', 'loyalty_points')) {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('loyalty_points')->default(0)->after('remember_token');
        });
    }

   
    Schema::create('wishlists', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('ticket_id');
        $table->timestamps();

        // Add foreign keys if needed
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
    });
}






    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    if (Schema::hasColumn('users', 'loyalty_points')) {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('loyalty_points');
        });

        
    }
}




};
