<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserLoginController extends Controller
{


    public function login(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email|max:255'
        ]);
        $user = User::where('email', $request['email'])->first();

        if ($user){
           Auth::loginUsingId($user->id);
            return redirect(route('menu.index'));
        }
        return redirect(url('/'));
    }
}
