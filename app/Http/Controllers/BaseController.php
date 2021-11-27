<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserInfo;
use App\Models\Attendance;
use App\Models\Permission;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BaseController extends Controller
{
    protected $user;

    public function __construct(){
      $this->user = JWTAuth::parseToken()->authenticate();
    }


    // Get User Info
    public function user_info(){

      // Check apakah role = admin
      $checkedUser = UserInfo::where('nip', $this->user->nip)->first();

      // Return user info sesuai hirarki
      if ($checkedUser->role == "admin"){
        $response = UserInfo::all();
      }else if ($checkedUser->role == "leader"){
        $response = UserInfo::where('role', "staff")->where('jabatan_fungsional', $checkedUser->jabatan_fungsional)->get();
      }else{
        $response = $checkedUser;
      }

      return response()->json([
        'success' => true,
        'requester' => $checkedUser,
        'message' => $response
      ], Response::HTTP_OK);
    }

    // Input absen
    /* Waktu absen => 0: belum absen
                   => 1: absen masuk
                   => 2: absen keluar
                   => 3: sudah absen
                   => 4: tidak dalam waktu absen 
    */
    public function attendance(){

      // Check user 
      $checkedUser = UserInfo::where('nip', $this->user->nip)->first();
      $namaPegawai = $checkedUser->nama_pegawai;
      $jabatanFun = $checkedUser->jabatan_fungsional;
      $jabatanStruk = $checkedUser->jabatan_struktural;
      $role = $checkedUser->role;


      // Get time data
      $dateNow = Carbon::now();
      $dateNowArr = $dateNow->toArray();
      $hourNow = $dateNowArr['hour'];
      $dayNow = $dateNowArr['day'];
      $monthNow = $dateNowArr['month'];
      $yearNow = $dateNowArr['year'];

      // Debug
      // $hourNow = 17;
      // $dayNow = 25;
      // $monthNow = 11;
      // $yearNow = 2021;

      // Set variable
      $flagCheckIn = false;
      $flagCheckOut = false;
      $checkInTime = 0;
      $checkOutTime = 0;

      $canCheckIn = true;
      $attend_code = 0;

      // Check masuk/pulang
      $first_check_in = 8;
      $last_check_in = 10;
      $first_check_out = 17;
      $last_check_out = 18;

      if (($hourNow >= $first_check_in) && ($hourNow <= $last_check_in)){
        $flagCheckIn = true;
        $checkInTime = $dateNow->format('H:i:s');
      } else if(($hourNow >= $first_check_out) && ($hourNow <= $last_check_out)){
        $flagCheckOut = true;
        $checkOutTime = $dateNow->format('H:i:s');
      }else{
        $canCheckIn = false;
      }

      // Update database attendance
      if ($canCheckIn){
        $checkUserAtt= Attendance::where('nip', $this->user->nip,)->where('tanggal', $dayNow)->first();
      
        if ($checkUserAtt != null){
          if (($checkUserAtt->flag_masuk) && !($checkUserAtt->flag_keluar)){

            Attendance::where('nip', $this->user->nip)
            ->where('tanggal', $dayNow)
            ->update([
              'jam_keluar' => $checkOutTime,
              'flag_keluar' => $flagCheckOut
            ]);

            $response = "absen_pulang";
            $attend_code = 2;

          }else if (($checkUserAtt->flag_masuk)&&($checkUserAtt->flag_keluar)){
            $response = "sudah_absen";
            $attend_code = 3;
          }

        }else{
          $attObj = [
            'tanggal' => $dayNow,
            'bulan' => $monthNow,
            'tahun'=> $yearNow,
            'jam_masuk' => $checkInTime,
            'flag_masuk' => $flagCheckIn,
            'jam_keluar'=> $checkOutTime,
            'flag_keluar'=> $flagCheckOut,
            'nip' => $this->user->nip,
            'nama_pegawai' => $namaPegawai,
            'jabatan_fungsional' => $checkedUser->jabatan_fungsional,
            'jabatan_struktural' => $checkedUser->jabatan_struktural,
            'role' => $checkedUser->role
          ];

          Attendance::create($attObj);
          $response = "absen_masuk";
          $attend_code = 1;
        }

      }else{
        return response()->json([
          'success' => false,
          'requester' => $checkedUser,
          'message' => "tidak_dalam_waktu_absen"
        ], Response::HTTP_OK);
      }
      

      return response()->json([
        'success' => true,
        'requester' => $checkedUser,
        'message' => $response,
        'attend_code' => $attend_code
      ], Response::HTTP_OK);
    }

    // Cek jumlah hadir
    public function attendSum(){
      // Check user
      $checkedUser = UserInfo::where('nip', $this->user->nip)->first();

      // Get time data
      $dateNow = Carbon::now();
      $dateNowArr = $dateNow->toArray();
      $fromDate = 1;
      $toDate = $dateNowArr['day'];
      $monthNow = $dateNowArr['month'];
      $yearNow = $dateNowArr['year'];

      // Get jumlah hadir antara tgl 1 sampai tanggal sekarang
      $attSum = Attendance::where('nip', $this->user->nip)
      ->where('flag_masuk', true)
      ->where('flag_keluar', true)
      ->where('bulan', $monthNow)
      ->where('tahun', $yearNow)
      ->whereBetween('tanggal', [$fromDate, $toDate])
      ->count();

      UserInfo::where('nip', $this->user->nip)
      ->update([
        'jumlah_hadir' => $attSum
      ]);

    }

    // Input izin
    public function permission(Request $request){

      // Check user 
      $checkedUser = UserInfo::where('nip', $this->user->nip)->first();
      $namaPegawai = $checkedUser->nama_pegawai;
      $jabatanFun = $checkedUser->jabatan_fungsional;
      $jabatanStruk = $checkedUser->jabatan_struktural;
      $jatahIzin = $checkedUser->jatah_izin;
      $jumlahSakit = $checkedUser->jumlah_sakit;
      $role = $checkedUser->role;

      // Get time data
      $dateNow = Carbon::now();
      $dateNowArr = $dateNow->toArray();
      $dayNow = $dateNowArr['day'];
      $monthNow = $dateNowArr['month'];
      $yearNow = $dateNowArr['year'];

      // Cek jatah izin
      if ($request->alasan == 'sakit'){
        // Update jumlah sakit
        $jumlahSakit = $jumlahSakit + 1;

        // Update data user info
        UserInfo::where('nip', $this->user->nip)
        ->update([
          'jumlah_sakit' => $jumlahSakit
        ]);

        $permObj = [
          'nip' => $this->user->nip,
          'nama_pegawai' => $namaPegawai,
          'alasan' => 'sakit',
          'tanggal_izin' => $dayNow,
          'bulan_izin' => $monthNow,
          'tahun_izin' => $yearNow,
          'jabatan_fungsional' => $jabatanFun,
          'jabatan_struktural' => $jabatanStruk,
          'role' => $role
        ];

        $response = $permObj;

      }else{
        // Update database permissions
        $permObj = [
          'nip' => $this->user->nip,
          'nama_pegawai' => $namaPegawai,
          'alasan' => $request->alasan,
          'tanggal_izin' => $dayNow,
          'bulan_izin' => $monthNow,
          'tahun_izin' => $yearNow,
          'jabatan_fungsional' => $jabatanFun,
          'jabatan_struktural' => $jabatanStruk,
          'role' => $role
        ];

        $response = Permission::firstOrCreate($permObj);
      }
      
      return response()->json([
        'success' => true,
        'requester' => $checkedUser,
        'message' => $response
      ], Response::HTTP_OK);
    }

    // Get semua pengajuan izin
    public function getAllPerm(){

    }


    // Update approval izin 
    // public function perm_update(Request $request){}

    // Tambah user baru
    // public function add_user(Request $request){}

    // Delete user
    // public function delete_user(Request $request){}

    // Uji coba cek alpha

    


}
