<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;

class UsersController extends Controller
{
    public function verify(Request $request,$token){
       $verifieduser = VerifyUser::where('token','=',$token)->first();
       if(isset($verifieduser)){
        $user = $verifieduser->user;
        if($user->email_verified_at == null){
            $user->email_verified_at = Carbon::now();
            $user->save();
            return \redirect()->to('/login')->with('success','Activation success. You can login now.');
        }else{
            return \redirect()->to('/login')->with('fail','You have already activated your account.');
        }
       }else{
        return \redirect()->to('/login')->with('fail','Activation code is not validate');
       }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if(!$user || !(Hash::check($request->password,$user->password))){
          return \back()->with('fail','Email Or Password is wrong');
        }else if($user->email_verified_at == null){
            return \back()->with('fail','You have not activated your account, yet.');
        }else{
            $request->session()->put('id',$user->id);
            return \redirect()->to('/account');
        }
    }

    public function loggedin(){
        if(Session::has('id')){
            $user = User::where('id','=',Session::get('id'))->first();
            return view('account',compact('user'));
        }
    }

    public function logout(){
        if(Session::has('id')){
            Session::pull('id');
            return \redirect()->to('/login');
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('edit',compact('user'));
    }

    public function saveupdate(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed\min:6'
        ]);

        $user = User::find($request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return \back()->with('success','Account Updated Successfully');
        }else{
            return \back()->with('fail','We could not save the changes.');
        }
    }

    public function forgetPassword(Request $request){
        $this->validate($request,[
            'email' => 'required|email|exists:users'
        ]);

        if(User::where('email','=',$request->email)->exists()){
            return \redirect()->to('/createnewpassword');
        }else{
            return \back()->with('fail','We could not verify your email address');
        }
    }

    public function createnewpassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = user::where('email','=',$request->email)->first();
        if(!$user){
          return \back()->with('fail','We could not validate your email address');
        }else{
            $user = User::where('email' ,'=', $request->email)->update(['password' => Hash::make($request->password)]);
            if($user){
                return \back()->with('success','New Password saved successfully. You can login now.');
            }else{
                return \back()->with('fail','We could not save your new password.');
            }
        }
    }

    public function deleteuser(){
        if(Session::has('id')){
            $user = User::where('id','=',Session::get('id'))->first();
            $user->delete();
            Session::pull('id');
            return \redirect()->to('/login')->with('fail','Your account is deleted. You will need to create a new account to be a member again.');
        }
    }
}
