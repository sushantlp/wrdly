<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThoughtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thoughts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('thought_id');
            $table->integer('habitant_id');
            $table->integer('theme_id');
            $table->string('heart_counter')->default(0);
            $table->string('view_counter')->default(0);
            $table->string('countribute_counter')->default(0);
            $table->string('subscribe_counter')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('thoughts');
    }
}
