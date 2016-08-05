<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class LovelyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function verify()
    {
        $user = Auth::user();
        dd('***');
        if($user->id === 2)
        {
            return true;
        }
    }
}
