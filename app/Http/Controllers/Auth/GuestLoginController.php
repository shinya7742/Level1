<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;

class GuestLoginController extends Controller
{
    public function login()
    {
        //ゲストユーザーの取得
        $guestUser = User::firstOrCreate(
            ['email' => 'guest@example.com'],
            ['name' => 'ゲスト', 'password' => bcrypt('password')]
        );

        //ゲストユーザーとしてログイン
        Auth::login($guestUser);

        Log::info('Logged in as guest user:', ['user' => Auth::user()]);
        // dd(Auth::user()); デバッグした情報表示

        //ログイン後のリダイレクト先を設定
        return redirect()->route('posts.index')->with('status', 'Logged in as guest user');
    }
}
