<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

  public function register(Request $request){
    // Validasi
    $data = $request->only('nip', 'nama_pegawai', 'password');
    $validator = Validator::make($data, [
      'nip' => 'required|unique:users|string',
      'nama_pegawai' => 'required|string',
      'password' => 'required|string|min:6|max:50'
    ]);

    // Kirim response gagal
    if ($validator->fails()){
      return response()->json(['error' => $validator->messages()], 200);
    }

    // Simpan user ke tabel users
    $user = User::create([
      'nip' => $request->nip,
      'nama_pegawai' => strtolower($request->nama_pegawai),
      'password' => bcrypt($request->password),
    ]);

    // Kirim response sukses
    return response()->json([
      'success' => true,
      'message' => 'User tersimpan',
      'data' => $user
    ], Response::HTTP_OK);
  }
    
  public function authenticate(Request $request){

    // Validasi input 
    $credentials = $request->only('nip', 'password');
    $validator = Validator::make($credentials, [
      'nip' => 'required|string',
      'password' => 'required|string|min:6|max:50'
    ]);

    // Kirim response gagal
    if ($validator->fails()){
      return response()->json(['error' => $validator->messages()], 200);
    }

    // Request tervalidasi
    // Create JWT Token
    try{
      if (! $token = JWTAuth::attempt($credentials)) {
        return response()->json([
          'success' => false,
          'message' => 'Data login invalid',
        ], 400);
    }
    }catch(JWTException $e){
      return $credentials;
      return response()->json([
            'success' => false,
            'message' => 'Tidak dapat membuat token',
          ], 500);
    }
    return response()->json([
      'success' => true,
      'token' => $token,
    ], 200);
  }

  public function logout(Request $request){
    // Validasi token
    $validator = Validator::make($request->only('token'),[
      'token' => 'required'
    ]);

    // Kirim response gagal
    if ($validator->fails()){
      return response()->json(['error' => $validator->messages()], 200);
    }

    // Response ketika token tervalidasi
    try {
      JWTAuth::invalidate($request->token);

      return response()->json([
          'success' => true,
          'message' => 'User berhasil logout'
      ]);
    } catch (JWTException $exception) {
      return response()->json([
        'success' => false,
        'message' => 'Maaf, terjadi kesalahan, tidak dapat logout'
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  public function get_user(Request $request){
    $this->validate($request, [
      'token' => 'required'
    ]);

    $user = JWTAuth::authenticate($request->token);

    return response()->json(['user' => $user]);
  }
}
