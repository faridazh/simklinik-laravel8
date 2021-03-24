<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoktersTable extends Migration
{
    public function up()
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();

            $table->char('dokterid', 6);
            $table->string('photo')->nullable();
            $table->string('nosertif');
            $table->date('validtill');
            $table->string('nostr');
            $table->string('norekom');
            $table->string('nama', 255);
            $table->string('namagelar', 500);
            $table->string('tempatlahir', 30);
            $table->date('datelahir');
            $table->string('alamat', 500);
            $table->string('keterangan', 2500)->nullable();
            $table->string('sertifikat')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokters');
    }
}
