<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller {

  public function logout(Request $request) {

    $request->user()->tokens()->delete();

    return response(['message' => 'Vous avez été déconnecté.']);

  }

  public function signup(SignupRequest $request) {

    $data = $request->validated();

    /** @var \App\Models\User $user */
    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => bcrypt($data['password'])
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response(compact('user', 'token'));

  }

  public function login(LoginRequest $request) {

    $credentials = $request->validated();

    if (!Auth::attempt($credentials)) {
      return response(['message' => 'Mot de passe incorrect.'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('auth_token', ['*'], Carbon::now()->addMinutes(15))->plainTextToken;

    return response(compact('user', 'token'));

  }

  public function me(Request $request) {

    $user = Auth::user();

    return response(compact('user'));

  }

}
