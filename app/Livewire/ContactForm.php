<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
     'name' => 'required|string',
     'email' => 'required|email',
     'subject' => 'required|string',
     'message' => 'required|max:500'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function SubmitContactForm(){
       $this->validate();

       $data = [
         'name' => $this->name,
         'email' => $this->email,
         'subject' => $this->subject,
         'message' => $this->message
       ];

       if(Mail::to('kumikwasi@yandex.com')->send(new ContactMail($data))){
        $this->resetInputFields();
        return \back()->with('success','Message sent. We will reply soon.');
       }else{
        return \back()->with('fail','We could not send your email.');
       }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function resetInputFields(){
        $this->name = "";
        $this->email = "";
        $this->subject = "";
        $this->message = "";
    }
}
