<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SocialAuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * ユーザーをTwitterの認証ページにリダイレクトする
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitterからユーザー情報を取得する
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }
    private function findOrCreateUser($twitterUser)
    {
        // \Log::debug(var_export($twitterUser, true));
        
        $authUser = User::where('twitter_id', $twitterUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        // ユーザーを作成して返却
        return User::create([
            'twitter_id' => $twitterUser->id,
            'screen_name' => $twitterUser->name,
            'name' => $twitterUser->nickname,
            'profile_image' => $twitterUser->avatar,
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}