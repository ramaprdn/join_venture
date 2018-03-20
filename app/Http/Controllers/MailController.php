<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function send(){
    	Mail::send(['text' => 'mail'], ['name','Rama'], function($message){
    		$message->to('ramapradana67@gmail.com', 'To Rama')->subject('Test message');
    		$message->from('joinventureid@gmail.com', 'Rama');
    	});
    }
}
