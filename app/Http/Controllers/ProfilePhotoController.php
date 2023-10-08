<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function uploadprofilephoto(Request $request){
        $request->validate([
          'email' => 'required|email|exists:users',
          'image' => 'required|image|max:1024|mimes:png,jpg,jpeg,gif',
        ]);

        if($request->hasFile('image')){
            $filePath = $request->file('image')->store('profile','public');
        }

        $user = User::where('email','=',$request->email)->first();
        if(!$user){
            return \back()->with('fail','We could not validate your email.');
        }else{
            Storage::disk('public')->delete($user->image);
            $user = User::where('email','=',$request->email)->update(['image' => $filePath]);
            if($user){
                return \back()->with('success','Profile Photo saved successfully.');
            }else{
                return \back()->with('fail','We could not save your profile photo.');
            }
        }
    }
}
