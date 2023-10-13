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
                'user' => User::where('email', $data['email'])->first()->toArray(),
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
                'user' => $user,
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
    // public function generateUrlImage()
    // {
    //     $count = 1;
    //     $urlImage = "";
    //     if ($count < 33) {
    //         if ($count > 16) {
    //             $urlImage = "/product-" . (33 - $count) . '-2.jpg';
    //         } else {
    //             $urlImage = "/product-" . $count . "-1.jpg";
    //         }
    //     } elseif ($count < 41 && $count >= 33) {
    //         $urlImage = "/category-thumb-" . (41 - $count) . ".jpg";
    //     } elseif ($count < 49 && $count >= 41) {
    //         $urlImage = "/thumbnail-" . (50 - $count) . ".jpg";
    //     }
    //     $count++;
    //     return $urlImage;
    // }
}
