<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();

            // Identitas Pasien
            $table->char('norm', 6)->unique();
            $table->string('nama', 150);
            $table->enum('kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('headfamily', 150);
            $table->string('hubfamily', 255);
            $table->enum('agama', ['Islam', 'Protestantisme', 'Katolisisme', 'Hinduisme', 'Buddhisme', 'Konghucu', 'Tidak Beragama'])->default('Tidak Beragama');
            $table->string('tempatlahir', 30)->nullable();
            $table->date('datelahir')->nullable();
            $table->string('alamat', 500);
            $table->char('telepon', 15)->nullable();
            $table->char('bpjs', 13)->nullable();
            $table->enum('statusnikah', ['Sudah Menikah', 'Belum Menikah'])->default('Belum Menikah');
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Tidak Sekolah'])->default('Tidak Sekolah');
            $table->string('pekerjaan', 50)->nullable();

            // Rekam Medis
            // Array == berat,tinggi,sistol,diastol,pulse //
            $table->string('rmringan', 19)->nullable();

            // Riwayat Alergi
            $table->string('alergi', 1000)->nullable();

            // Riwayat Penyakit Yang Diderita Saat Ini
            $table->string('penyakitskrg', 1000)->nullable();

            // Riwayat Penyakit Pada Keluarga
            $table->string('penyakitfamily', 1000)->nullable();

            // Riwayat Imunisasi (Array)
            // BCG,Polio,Hepatitis,DPT,Campak,DT,Covid19 == (Usia,Usia,Usia,Frekuensi,Frekuensi,Frekuensi,Frekuensi) //
            $table->string('imunisasi', 30)->nullable();

            // Riwayat Keluarga Berencana (Kandungan)
            // Suntik,Implant,Tubektomi,Pil,AKDR,Vasektomi,Pasritas,Abortus == (Tahun,Tahun,Tahun,Tahun,Tahun,Tahun,Tahun,Tahun,Frekuensi,Frekuensi) //
            $table->string('kb_riwayat', 50)->nullable();
            $table->string('kb_operasi', 1000)->nullable();

            // Riwayat Lain
            // Array == Tempat,Date,Alasan //
            $table->string('riwayatrawat')->nullable();
            $table->string('riwayatoperasi')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}
