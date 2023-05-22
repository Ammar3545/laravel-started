<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // $user=User::where('email',$request->input('email'))->first();
        // if (!$user) {
        //     return 'not found';
        // }else{
        //     if (Hash::check($request->input('password'),$user->password)) {
        //         $tokenCreated=$user->createToken('authToken');
        //         return response()->json([
        //             'message'=>'loging successfully',
        //             'user'=>$user,
        //             'token'=> $user->createToken('Token Name')->accessToken, //$tokenCreated->accessToken,
        //             'token_type'=>'Bearer',
        //             // 'expires_at'=>Carbon::parse($tokenCreated->token->expires_at)->toDateTimeString(),
        //         ]);
        //         // return 'loging successfully';
        //     }
        // }

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $user=auth()->user();
            $user['token']=$user->createToken('access name')->accessToken;
            return $user;
                }

                return "404";
        // return $user;
    }
}
