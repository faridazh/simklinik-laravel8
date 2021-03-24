<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntriansTable extends Migration
{
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();

            $table->string('antrian', 6)->unique();
            $table->char('norm', 6);
            $table->string('nama', 255);
            $table->enum('jenis', ['Apotek','Dokter','Kasir','Laboratorium']);
            $table->enum('status', ['Sudah', 'Sedang', 'Belum'])->default('Belum');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('antrians');
    }
}
