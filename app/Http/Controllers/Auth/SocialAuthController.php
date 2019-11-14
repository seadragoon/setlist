<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use InvalidArgumentException;

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
        $previous = url()->previous();
        
        // デバッグ用
        // ダミーユーザーでログインしたことにして元のページに戻す
        $isDebug = true;

        if ($isDebug) {
            $dummyUser = User::first();
            Auth::login($dummyUser, true);
            return redirect($previous);
        }
        
        // \Log::debug("previous : " . $previous);
        
        // セッションに遷移元URLを格納
        session(['url.previous' => $previous]);

        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitterからユーザー情報を取得する
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        // セッションから遷移元URLを取得
        $redirectUrl = session('url.previous');
        // セッションから消しておく
        session()->forget('url.previous');

        // \Log::debug("redirectUrl : " . $redirectUrl);

        try {
            $user = Socialite::driver('twitter')->user();
        } catch (InvalidArgumentException $e) {
            // \Log::debug($e);

            return redirect($redirectUrl);
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        // twitterユーザーが取得できたのでユーザーデータ経由で取得
        $authUser = $this->findOrCreateUser($user);

        // ログイン
        Auth::login($authUser, true);

        return redirect($redirectUrl);
    }
    private function findOrCreateUser($twitterUser)
    {
        // \Log::debug(var_export($twitterUser, true));
        
        $authUser = User::where('twitter_id', $twitterUser->id)->first();

        if ($authUser){
            // 毎回ログインする度に最新データに更新する
            $authUser->screen_name = $twitterUser->name;
            $authUser->name = $twitterUser->nickname;
            $authUser->profile_image = $twitterUser->avatar;
            $authUser->save();

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
        // ログアウト
        Auth::logout();

        return redirect(url()->previous());
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}