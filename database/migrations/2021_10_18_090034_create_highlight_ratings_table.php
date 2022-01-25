<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlight_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('ip_address');
            $table->string('user_id');
            $table->string('highlight_id');
            $table->integer('rating');
            $table->string('agent');
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('highlight_ratings');
    }
}
