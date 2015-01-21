<?php

class HomeController extends BaseController {

	
	 public function home()
	 {
	 	// Mail::send('emails.auth.test', array('name'=>'jay'), function($message){
	 	// 	$message->to('desai.jay3@gmail.com', 'jay desai')->subject('Test Mail');
	 	// });	

	 	return View::make('home'); 
	 }



}
