<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlight_views', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('ip_address');
            $table->string('user_id')->nullable();
            $table->string('highlight_id');
            $table->string('agent');
            $table->integer('view')->nullable();
//            $table->text('comment');
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
        Schema::dropIfExists('highlight_views');
    }
}
