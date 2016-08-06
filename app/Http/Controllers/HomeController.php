<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Gate;
use App\User;
use Auth;

/**
 * Added By Rudragoud Patil
 * To support Socialite - facebook and google
 */
use Laravel\Socialite\Facades\Socialite;
/**
 * end
 */

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

}
