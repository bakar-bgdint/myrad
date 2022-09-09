<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    
public function profileView(){
    $id=Auth::user()->id;
    $user=User::where('id',$id)->first();
    // dd($user);
    return view('profile.userProfile',[
        'users'=> $user,

    ]);
}

public function userSettingsView(){

}
}
