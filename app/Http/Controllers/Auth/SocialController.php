<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Social;
use App\User;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        $providerKey = Config::get('services.'.$provider);

        if (empty($providerKey)) {

            return redirect('/login')
            ->withError('No such provider yet');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handle($provider)
    {
        
        try {
            $socialUserObject = Socialite::driver($provider)->stateless()->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
        }
        // dd($socialUserObject);

        $socialUser = null;

        // Check if email is already registered
         $userCheck = User::where('email', '=', $socialUserObject->email)->first();

         $email = $socialUserObject->email;

        if (!$socialUserObject->email) {
            $email = 'missing'.str_random(10).'@'.str_random(10).'.example.org';
        }

        // dd($email);
        
        if (empty($userCheck)) {
            $sameSocialId = Social::where('social_id', '=', $socialUserObject->id)
                ->where('provider', '=', $provider)
                ->first();

            if (empty($sameSocialId)) {
                $socialData = new Social();
                $profile = new Profile();
                $fullname = explode(' ', $socialUserObject->name);
                if (count($fullname) == 1) {
                    $fullname[1] = '';
                }
                $username = $socialUserObject->nickname;

                if ($username == null) {
                    foreach ($fullname as $name) {
                        $username .= $name;
                    }
                }

                $user = User::create(
                    [
                    'name'                 => $username,
                    'first_name'           => $fullname[0],
                    'last_name'            => $fullname[1],
                    'email'                => $email,
                    'password'             => bcrypt(str_random(40)),
                    'verified'             => true,
                    ]
                );

                $socialData->social_id = $socialUserObject->id;
                $socialData->provider = $provider;
                $user->social()->save($socialData);
                $user->verified = true;

                $user->profile()->save($profile);
                $user->save();

                if ($socialData->provider == 'github') {
                    $user->profile->github_username = $socialUserObject->nickname;
                }

                // Twitter User Object details: https://developer.twitter.com/en/docs/tweets/data-dictionary/overview/user-object
                if ($socialData->provider == 'twitter') {
                    $user->profile()->twitter_username = $socialUserObject->screen_name;
                }
                $user->profile->save();

                $socialUser = $user;
            } else {
                $socialUser = $sameSocialId->user;
            }

            auth()->login($socialUser, true);

            return redirect('home')->with('success', 'You have successfully registered! ');
        }

        $socialUser = $userCheck;
        
        auth()->login($socialUser, true);

        return redirect('home');
    }
}
