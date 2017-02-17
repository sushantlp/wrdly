<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotionBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notion_books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->integer('thought_id');
            $table->integer('habitant_id');
            $table->text('chapter');
            $table->tinyInteger('status')->default(1);  // Zero for Reject and One for Pending and Two for Approve
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
        Schema::dropIfExists('notion_books');
    }
}
