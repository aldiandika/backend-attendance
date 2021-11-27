<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
      'nip',
      'nama_pegawai',
      'alasan',
      'tanggal_izin',
      'bulan_izin',
      'tahun_izin',
      'jabatan_fungsional',
      'jabatan_struktural',
      'role'
    ];
}
