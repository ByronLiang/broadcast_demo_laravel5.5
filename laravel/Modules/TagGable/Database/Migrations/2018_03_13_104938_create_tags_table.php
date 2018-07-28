<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('tag_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('sort_order')->default(0);
            $table->boolean('fixed')->default(0);
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('sort_order')->default(0);
            $table->json('extend')->nullable();
            $table->timestamps();

            $table->unsignedInteger('tag_group_id')->nullable();
            $table->foreign('tag_group_id')->references('id')->on('tag_groups')->onDelete('cascade');
        });

        Schema::create('tag_gables', function (Blueprint $table) {
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('extend')->nullable();

            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->unsignedInteger('gable_id');
            $table->string('gable_type');
            $table->index(['gable_id', 'gable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_gables');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_groups');
    }
}
