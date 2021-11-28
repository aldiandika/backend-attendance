<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserInfo;
use Carbon\Carbon;

class UserInfoSeeder extends Seeder
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

        $userInfo = [
          [
            'nip' => '12010041',
            'nama_pegawai' => 'budi',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'manager',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'admin',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '12020042',
            'nama_pegawai' => 'wati',
            'jabatan_fungsional' => 'administrasi',
            'jabatan_struktural' => 'manager',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'admin',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '12020043',
            'nama_pegawai' => 'iwan',
            'jabatan_fungsional' => 'administrasi',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '13020046',
            'nama_pegawai' => 'yudi',
            'jabatan_fungsional' => 'administrasi',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '12010043',
            'nama_pegawai' => 'ari',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'team leader',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'leader',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '12010044',
            'nama_pegawai' => 'susi',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'team leader',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'leader',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '13010049',
            'nama_pegawai' => 'ari',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '13010050',
            'nama_pegawai' => 'medi',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '13010051',
            'nama_pegawai' => 'susan',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '13030052',
            'nama_pegawai' => 'andi',
            'jabatan_fungsional' => 'support',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ],
          [
            'nip' => '13010053',
            'nama_pegawai' => 'hasan',
            'jabatan_fungsional' => 'engineer',
            'jabatan_struktural' => 'staff',
            'jumlah_izin' => 0,
            'jumlah_sakit' => 0,
            'jumlah_alpha' => 0,
            'jumlah_hadir' => 0,
            'role' => 'staff',
            'created_at' => $dateNowArr['formatted'],
            'updated_at' => $dateNowArr['formatted']
          ]
        ];
        UserInfo::insert($userInfo);
    }
}
