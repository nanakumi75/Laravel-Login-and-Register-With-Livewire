<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class QuestionsController extends Controller
{
    public function getresponses(Request $request){
        $response = Http::get('https://quizapi.io/api/v1/questions',[
        'apiKey' => 'API_KEY_HERE',
        'limit' => 15
        ]);

        $questions = json_decode($response->body());
        return view('welcome',compact('questions'));
    }
}
