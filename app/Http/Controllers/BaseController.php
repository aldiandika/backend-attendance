<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserInfo;
use App\Models\Attendance;

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

      // Cek jumlah hadir/alpha/izin

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
      // $hourNow = $dateNowArr['hour'];

      // Debug
      $hourNow = 17;

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
        $checkUserAtt= Attendance::where('nip', $this->user->nip,)->where('tanggal', $dateNowArr['day'])->first();

        if ($checkUserAtt != null){
          if (($checkUserAtt->flag_masuk) && !($checkUserAtt->flag_keluar)){

            Attendance::where('nip', $this->user->nip)
            ->where('tanggal', $dateNowArr['day'])
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
            'tanggal' => $dateNowArr['day'],
            'bulan' => $dateNowArr['month'],
            'tahun'=> $dateNowArr['year'],
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
    // public function attendSum(){}

    // Tambah user baru
    // public function add_user(Request $request){}

    // Delete user
    // public function delete_user(Request $request){}

    // Input izin
    // public function permission(Request $request){}

    // Update approval izin 
    // public function perm_update(Request $request){}


}