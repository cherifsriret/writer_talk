<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('favorite_genres')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('country_code')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('status');
            $table->string('bio')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->default(0)->nullable();
            $table->integer('show_top_hundered')->default(0)->comment('0:no, 1:yes')->nullable();
            $table->string('promo_code')->nullable();
            $table->integer('promo_used')->default(0)->nullable();
            $table->integer('referral_used')->default(0)->nullable();
            $table->integer('verify_user')->default(0);
            $table->integer('invitation_key')->nullable();
            $table->text('secret_key');
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->string('device_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
