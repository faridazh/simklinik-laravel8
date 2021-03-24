<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();

            $table->string('code', 20);
            $table->string('namaindo', 500);
            $table->string('namainggris', 500);
            $table->string('keterangan', 1000)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
