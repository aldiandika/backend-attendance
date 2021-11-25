<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserInfo;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $user;

    public function __construct(){
      $this->$user = JWTAuth::parseToken()->authenticate();
    }


    // Index
    public function user_info_index(){

      // Check apakah role = admin

      // Return semua user_info

      // Return user_info dari user terkait
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
