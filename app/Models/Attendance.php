<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
      'tanggal',
      'bulan',
      'tahun',
      'jam_masuk',
      'flag_masuk',
      'jam_keluar',
      'flag_keluar',
      'nip',
      'nama_pegawai',
      'jabatan_fungsional',
      'jabatan_struktural',
      'role'
    ];


}
