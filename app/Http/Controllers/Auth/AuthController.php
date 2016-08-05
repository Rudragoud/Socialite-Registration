<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
/**
 * Added By Rudragoud Patil
 * To support Socialite - facebook and google
 */
use Laravel\Socialite\Facades\Socialite;
/**
 * end
 */

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * [redirectToProvider user direct to social media]
     * @param  [type] $provider [google,facebook or ...]
     * @return [type]           [string]
     */
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

     /**
     * [handleProviderCallback handle return status of social media]
     * @param  [type] $provider [google,facebook or ...]
     * @return [type]           [string]
     */
    public function handleProviderCallback($provider)
    {
         //notice we are not doing any validation, you should do it
        $user = Socialite::driver($provider)->user();

        switch ($provider){

            case 'google':
                    
                    $data = $this->prepareGoogleData($user);
                    
                    Auth::login(User::firstOrCreate($data));

                break;
            case 'facebook':
                    
                    $data = $this->prepareFacebookData($user);
                    
                    Auth::login(User::firstOrCreate($data));

                break;

            default:
                # code...
                break;
        }

        return redirect('/');
    }

    private function prepareFacebookData($user)
    {
        $firstname = $lastname = '';
        $name = explode(" ",$user->user['name']);
        if(isset($name[0]))
        {
            $firstname = $name[0];    
        }
        if(isset($name[1]))
        {
            $lastname = $name[1];
        }
        if(isset($user->user['first_name']))
        {
            $firstname = $user->user['first_name'];
        }
        if(isset($user->user['last_name']))
        {
            $lastname = $user->user['last_name'];
        }

        return [
                    'email' => $user->getEmail(),
                    'name' => $firstname,
                    'password' => 'demo1234'
                ];
    }

    private function prepareGoogleData($user)
    {
        return [
                    'email' => $user->getEmail(),
                    'name' => $user->user['name']['givenName'],
                    'password' => 'demo1234'
                ];
    }

}
