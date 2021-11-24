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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('bulan');
            $table->string('tahun');
            $table->timestampTz('jam_masuk', $precision=0);
            $table->boolean('flag_masuk');
            $table->timestampTz('jam_keluar', $precision=0);
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
        Schema::dropIfExists('attendance');
    }
}
