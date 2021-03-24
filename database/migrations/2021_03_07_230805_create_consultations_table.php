<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();

            $table->char('code', 6)->unique();
            $table->char('norm', 6);
            $table->string('nama', 150);
            $table->date('tanggal');
            $table->string('anamnesis')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('diagnosalain')->nullable();
            $table->string('tindakan')->nullable();
            $table->enum('resep', ['Tidak', 'Belum', 'Sedang', 'Sudah'])->default('Belum');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultations');
    }
}
