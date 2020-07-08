<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToTalbeInstagramAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_instagram_access', function (Blueprint $table) {
            $table->integer('expires_in')->default(0);
            $table->string('token_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('talbe_instagram_access', function (Blueprint $table) {
            $table->dropColumn('expires_in');
            $table->dropColumn('token_type');
        });
    }
}
