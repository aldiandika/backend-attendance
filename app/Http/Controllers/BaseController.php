<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserInfo;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

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
        'message' => $response
      ], Response::HTTP_OK);
    }

    // Input absen
    // public function attendance(Request $request){}

    // Tambah user baru
    // public function add_user(Request $request){}

    // Delete user
    // public function delete_user(Request $request){}

    // Input izin
    // public function permission(Request $request){}

    // Update approval izin 
    // public function perm_update(Request $request){}


}
