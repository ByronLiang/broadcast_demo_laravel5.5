<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberToCatagory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catagory', function (Blueprint $table) {
            $table->tinyInteger('number')->nullable()->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catagory', function (Blueprint $table) {
            $table->dropColumn('number');
        });
    }
}
