<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {

    use ResponseAPI;

    public function index(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error(
                'These credentials do not match our records.',
                500
            );
        }

        $user->tokens()->delete();

        $accessToken = "AccessToken: " . $user->username;

        $token = $user->createToken($accessToken)->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
            'expired_at' => now()->addHour(12)
        ];

        return $this->success(
            'Login success.',
             $data,
        );
    }

    public function logout(Request $request) {

        $logout = auth()->user()->currentAccessToken()->delete();

        if ($logout) {
            return $this->success(
                'Logout berhasil.',
            );
        }

        return $this->error('logout gagal');
    }
}
