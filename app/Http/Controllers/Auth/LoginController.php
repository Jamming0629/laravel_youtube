<?php

namespace App\Http\Controllers\Auth;

//use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

//use Socialite; // 追記

class LoginController extends Controller
{
    // 省略
    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
        //return redirect('/index');
    }

    // public function handleGoogleCallback()
    // {
    //     //Google 認証後の処理
    //     //あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認
    //     $gUser = Socialite::driver('google')->stateless()->user();
    //     dd($gUser);
    // }
    public function authGoogleCallback()
    {
        // $googleUser = Socialite::driver('google')->stateless()->user();
        // $user = User::firstOrCreate([
        //     'email' => $googleUser->email
        // ], [
        //     'email_verified_at' => now(),
        //     'google_id' => $googleUser->getId()
        // ]);
        // Auth::login($user, true);
        return redirect('index');
    }
}
    //public function handleGoogleCallback()
    // {
    //     $gUser = Socialite::driver('google')->stateless()->user();
    //     // email が合致するユーザーを取得
    //     $user = User::where('email', $gUser->email)->first();
    //     // 見つからなければ新しくユーザーを作成
    //     if ($user == null) {
    //         $user = $this->createUserByGoogle($gUser);
    //     }
    //     // ログイン処理
    //     \Auth::login($user, true);
    //     return redirect('/home');
    // }

    // public function createUserByGoogle($gUser)
    // {
    //     $user = User::create([
    //         'name'     => $gUser->name,
    //         'email'    => $gUser->email,
    //         'password' => \Hash::make(uniqid()),
    //     ]);
    //     return $user;
    // }

