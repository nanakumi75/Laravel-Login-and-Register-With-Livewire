<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //user functions
    public function register(Request $request){
      $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6'
      ]);

      $user = User::create([
           'name' => $fields['name'],
           'email' => $fields['email'],
           'password' => Hash::make($fields['password'])
      ]);

      $token = $user->createToken('myapptoken')->plainTextToken;
      $response = [
           'user' => $user,
           'token' => $token,
           'type' => 'bearer'
      ];

      return response($response,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
          'email' => 'required|email|exists:users',
          'password' => 'required'
        ]);

        $user = User::where('email','=',$fields['email'])->first();
        if(!$user || !(Hash::check($fields['password'],$user->password))){
            return response([
             'message' => 'Email or Password is wrong'
            ],404);
        }else{
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
             'user' => $user,
             'token' => $token,
             'type' => 'bearer'
            ];
           return response($response,201);
        }
    }

    public function logout(){
      auth()->user()->tokens()->delete();

        return response([
           'message' => 'You are logged out now'
        ]);
    }

    //student functions
    public function store(Request $request){
         $request->validate([
           'first_name' => 'required|string',
           'last_name' => 'required|string',
           'email' => 'required|email|unique:students',
           'department' => 'required|string',
           'course' => 'required|string'
         ]);

         return Student::create($request->all());
    }

    public function index(){
        return Student::all();
    }

    
    public function show($id){
        return Student::find($id);
    }

    public function update(Request $request,$id){
         $user = Student::where('id','=',$id)->first();
        return $user->update($request->all());
    }

    public function search(Request $request,$name){
        return Student::where('first_name','LIKE','%'.$name.'%')
        ->OrWhere('last_name','LIKE','%'.$name.'%')
        ->OrWhere('email','LIKE','%'.$name.'%')
        ->OrWhere('department','LIKE','%'.$name.'%')
        ->OrWhere('course','LIKE','%'.$name.'%')
        ->get();
    }

    public function delete($id){
        if(Student::where('id','=',$id)->exists()){
            $student = Student::find($id)->first();
            $student->delete();

            return response([
              'message' => 'Student Deleted'
            ]);
        }
    }
}
