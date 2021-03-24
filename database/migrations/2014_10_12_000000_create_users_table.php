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
            $table->string('staffid', 6)->unique();
            $table->string('name');
            $table->string('username', 30)->unique();
            $table->enum('level', ['Administrator','Staff','Apoteker','Dokter','Kasir','Resepsionis']);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidclear
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
