<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('tanggal');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('jam_masuk');
            $table->boolean('flag_masuk');
            $table->string('jam_keluar');
            $table->boolean('flag_keluar');
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('jabatan_fungsional');
            $table->string('jabatan_struktural');
            $table->string('role');
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
        Schema::dropIfExists('attendances');
    }
}
