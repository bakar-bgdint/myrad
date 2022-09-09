<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordEmail;
use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Socialite;
use Exception;

class AuthController extends Controller
{


    protected $redirectTo = '/dashboard';


    public function dashboardView()
    {
        return view('layouts.app_layout');
    }


    public function loginView(){
        return view('auth.login');
    }



    //login
    public function login(request $request)
    {
        // dd($request);
        // validating the request input
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:4|max:6',
        ]);


        $user = User::where('email', $request->email)
        ->orWhere('name', $request->email)->first();
        // dd($user);


        //making credientials array
        $credentials = [
            'email' => $user->email,
            'password' => $request->password,
        ];
        // dd($credentials);
        //authenticating the user credentials
        if(!Auth::attempt($credentials)) {
            return Redirect::back()
            ->with('error','Incorrect Email or Password');
        }
        return Redirect::to('/dashboard')
        ->with('success','Log In Successfull');

    }

    public function registerView(){
        return view('auth.register');
    }

    public function register(request $request){
        // dd($request);
        //validating the request input
       $validate= $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=> 'required|max:11|min:11',
            'password'=>'required|min:6|max:10',
            'cpassword' => 'required|same:password|min:4|max:6',
            'gender'=> 'required',
            'terms' =>'required',

        ]);

        

        //check for duplicate user email
        if (User::where('email', '=', $request->email)->exists()) {
            return Redirect::back()->with('error','User Already Exists');
         }

         //creting user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
             'gender' =>$request->gender,
             'terms' => $request->terms,
        ]);

        //random token for email verification
        $token =  Str::random(64);

        // insert record to verify email table
        DB::table('verify_email')->insert([
            'user_id' => $user->id,
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()]
      );

      //url for email verification
      $url = env('APP_URL').'/verifyEmail/'.$token;
      //sending mail to user
      Mail::to($user->email)->send(new VerifyEmail($url));
      return back()->with('info', 'We have e-mailed you Email Verification link!');

    }


    public function emailVerify($token)
    {
        //compairing token for email verification
        $verifyUser = DB::table('verify_email')->where('token', $token)->first();

        if($verifyUser){
            User::where('id', $verifyUser->user_id)->update(['email_verified_at'=>Carbon::now()]);
              $status = "Your e-mail is verified. You can now login.";
        }
        else {
            return Redirect::to('/login')->with('warning','Email Not Verified');
          }

          return  Redirect::to('/login')->with('success','Email Verified Successfully');
    }


    public function forgetPwdView(){
        return view('auth.forgetPwd');
    }

    public function forgetPwd(Request $request){
        // validating the data
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        //genrating random token and insert data to password reset table
        $token =  Str::random(64);
        DB::table('password_resets')->insert(
          ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        //url for password_resets
        $url = env('APP_URL').'/resetPassword/'.$token;
        // sending mail
        Mail::to($request->email)->send(new ForgetPasswordEmail($url));
        return back()->with('info', 'We have e-mailed your password reset link!');
    }

    public function changePwdView($token){
        return view('auth.changePwd',compact('token'));
    }

    public function changePwd(Request $request){
        // dd($request);
        // validating the request input
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:4|max:6',
            'cpassword' => 'required|same:password|min:4|max:6',
        ]);

        // matching token for password updation
        $updatePassword = DB::table('password_resets')
        ->where(['token' => $request->token])
        ->first();
        // dd($updatePassword);

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
        else{
            //updating password
            DB::table('users')->where('email', $updatePassword->email)
            ->update(['password' =>bcrypt($request->password)]);
            // discard user whose password has been chnged from password_resets
            DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();
        }

        return  Redirect::to('/login')->with('info', 'Your password has been changed!');
    }
 }
