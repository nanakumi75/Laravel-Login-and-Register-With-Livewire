<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailConfirmation;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;

class RegisterForm extends Component
{
    #[Rule('required|string')]
      public $name;

    #[Rule('required|email|unique:users')]
      public $email;

    #[Rule('required|confirmed|min:6')]
       public $password;

    #[Rule('required')]
       public $password_confirmation;


       public function updated($propertyName){
        $this->validateOnly($propertyName);
       }

       public function SubmitRegisterForm(){
        $this->validate();
        $user = new User;
        $user->name = strip_tags($this->name);
        $user->email = strip_tags($this->email);
        $user->password = strip_tags(Hash::make($this->password));
        $user->save();

        $users = new VerifyUser;
        $users->token = Str::random(60);
        $users->user_id = $user->id;
        $users->save();

        if(Mail::to($user->email)->send(new EmailConfirmation($user))){
            $this->resetInputFields();
            return \back()->with('success','Registration success.Please check your email to activate your account.');
        }else{
            return \back()->with('fail','We could not register your account.');
        }
       }


    public function render()
    {
        return view('livewire.register-form');
    }

    public function resetInputFields(){
        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->password_confirmation = "";
    }
}
