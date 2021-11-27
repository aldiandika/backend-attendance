<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'jabatan_fungsional',
        'jabatan_struktural',
        'jumlah_izin',
        'jumlah_alpha',
        'jumlah_hadir',
        'role'
    ];
}
