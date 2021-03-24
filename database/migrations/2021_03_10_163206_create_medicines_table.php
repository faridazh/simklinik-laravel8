<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();

            $table->char('code', 6)->unique();
            $table->string('namaobat', 255)->unique();
            $table->string('isiobat', 500);
            $table->enum('golongan', ['Bebas','Bebas Terbatas','Keras','Golongan Narkotik','Fitofarmaka','Herbal Terstandar (OHT)','Herbal (Jamu)']);
            $table->enum('jenis', ['Tablet','Kapsul','Kaplet','Pil','Puyer','Larutan','Koyo','Sirop','Gas','Drops','Salep','Injeksi','Suntik', 'Gel', 'Krim', 'Spray']);

            $table->integer('stok')->default(0);
            $table->integer('harga_beli')->default(0);
            $table->integer('harga_jual')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
