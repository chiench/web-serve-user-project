<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $data = $loginRequest->validated();
        if (Auth::attempt($data)) {
            $token = Str::random(36);
            return response()->json([
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Tài khoản và mật khẩu không đúng',
            ], 422);
        }
    }

    public function register(RegisterRequest $registerRequest)
    {
        // User::truncate();
        $data = $registerRequest->validated();
        $data['password'] = Hash::make($data['password']);
        try {
            DB::beginTransaction();
            $user = User::create($data);
            //create token
            $token = Str::random(36);
            DB::commit();
            return response()->json([
                'data' => $user,
                'token' => $token,
            ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    public function logout(Request $request)
    {
        dd(2);

    }
}
