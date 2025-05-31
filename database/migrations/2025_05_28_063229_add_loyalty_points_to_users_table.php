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
    if (!Schema::hasColumn('users', 'loyalty_points')) {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('loyalty_points')->default(0)->after('remember_token');
        });
    }
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
