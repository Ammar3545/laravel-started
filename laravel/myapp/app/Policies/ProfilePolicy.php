<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Profile $profile){
        return $user->id  == $profile->id;
    }

    public function create(User $user){
        // return Response::allow("you must be an admin");
        return true;
    }
}
