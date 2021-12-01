<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\UserInfo;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
      $dateNow = Carbon::now();
      $dateNowArr = $dateNow->toArray();
      $year = 2021;
      $month = 11;
      

      $users = UserInfo::all();

      foreach($users as $user){
        $date = 0;
        $date2 = 8;
        $date3 = 15;
        $date4 = 22;

        for ($i=0; $i<5; $i++){
          $date += 1;
          $dataUser = [
            'tanggal' => $date,
            'bulan' => $month,
            'tahun' => $year,
            'jam_masuk' => "08:00:00",
            'flag_masuk' => true,
            'jam_keluar'=> "17:00:00",
            'flag_keluar' => true,
            'nip' => $user->nip,
            'nama_pegawai' => $user->nama_pegawai,
            'jabatan_fungsional' => $user->jabatan_fungsional,
            'jabatan_struktural' => $user->jabatan_struktural,
            'role'=> $user->role,
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ];
          Attendance::insert($dataUser);
        }

        for ($i=0; $i<5; $i++){
          $date2 += 1;
          $dataUser = [
            'tanggal' => $date2,
            'bulan' => $month,
            'tahun' => $year,
            'jam_masuk' => "08:00:00",
            'flag_masuk' => true,
            'jam_keluar'=> "17:00:00",
            'flag_keluar' => true,
            'nip' => $user->nip,
            'nama_pegawai' => $user->nama_pegawai,
            'jabatan_fungsional' => $user->jabatan_fungsional,
            'jabatan_struktural' => $user->jabatan_struktural,
            'role'=> $user->role,
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ];
          Attendance::insert($dataUser);
        }

        for ($i=0; $i<5; $i++){
          $date3 += 1;
          $dataUser = [
            'tanggal' => $date3,
            'bulan' => $month,
            'tahun' => $year,
            'jam_masuk' => "08:00:00",
            'flag_masuk' => true,
            'jam_keluar'=> "17:00:00",
            'flag_keluar' => true,
            'nip' => $user->nip,
            'nama_pegawai' => $user->nama_pegawai,
            'jabatan_fungsional' => $user->jabatan_fungsional,
            'jabatan_struktural' => $user->jabatan_struktural,
            'role'=> $user->role,
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ];
          Attendance::insert($dataUser);
        }

        for ($i=0; $i<4; $i++){
          $date4 += 1;
          $dataUser = [
            'tanggal' => $date4,
            'bulan' => $month,
            'tahun' => $year,
            'jam_masuk' => "08:00:00",
            'flag_masuk' => true,
            'jam_keluar'=> "17:00:00",
            'flag_keluar' => true,
            'nip' => $user->nip,
            'nama_pegawai' => $user->nama_pegawai,
            'jabatan_fungsional' => $user->jabatan_fungsional,
            'jabatan_struktural' => $user->jabatan_struktural,
            'role'=> $user->role,
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ];
          Attendance::insert($dataUser);
        }

        if (!($user->nama_pegawai == "iwan") || !($user->nama_pegawai == "susan") || !($user->nama_pegawai == "andi"))
        $dataUser = [
          'tanggal' => 26,
          'bulan' => $month,
          'tahun' => $year,
          'jam_masuk' => "08:00:00",
          'flag_masuk' => true,
          'jam_keluar'=> "17:00:00",
          'flag_keluar' => true,
          'nip' => $user->nip,
          'nama_pegawai' => $user->nama_pegawai,
          'jabatan_fungsional' => $user->jabatan_fungsional,
          'jabatan_struktural' => $user->jabatan_struktural,
          'role'=> $user->role,
          'created_at' => $dateNowArr['formatted'],
          'updated_at' => $dateNowArr['formatted']
        ];
      }

    }
}
