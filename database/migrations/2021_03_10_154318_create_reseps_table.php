<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepsTable extends Migration
{
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();

            $table->char('code', 6);
            $table->char('norm', 6);
            $table->string('nama', 150);
            $table->string('resep');
            $table->enum('status', ['Belum','Sedang','Sudah'])->default('Belum');

            $table->timestamps();
            // $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reseps');
    }
}
