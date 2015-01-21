<?php

class AccountController extends BaseController
{
	public function getSignIn()
	{
		return View::make('account.signin');
	}

	public function postSignIn()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'email'=>'required|email',
				'password' =>'required'
				)
			);

		if($validator->fails())
		{
			return Redirect::route('account-sign-in')
							->withErrors($validator)
							->withInput();
		}
		else
		{
			$remember =(Input::has('remember')) ? true : false;
			//attempts sign in by user
			$auth = Auth::attempt(
				array(
				'email' => Input::get('email'),
				'password'=>Input::get('password'),
				'active' =>1,

				), $remember);
			if($auth)
			{
				//redirect to the intended url 
				return Redirect::intended('/')
								->with('global','You are logged in');
			}

		}
		
		return Redirect::route('account-sign-in')
						->with('global', 'There was a problem signing you');
	}

	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home')->with('global','You are now logged out');
	}

	public function getChangePassword()
	{
		return View::make('account.password');
	}

	public function postChangePassword()
	{
		$validator = Validator::make(Input::all(),array(
			'old_password'=>'required',
			'password' =>'required|min:6',
			'password_again'=>'required|same:password'

			)
		);

		if($validator->fails())
		{
			return Redirect::route('account-change-password')
							->withErrors($validator);
		}
		else{

			$user = User::find(Auth::user()->id);
			$old_password = Input::get('old_password');
			$password = Input::get('password');
			
			if(Hash::check($old_password, $user->getAuthPassword()))
			{
				$user->password = Hash::make($password);

				if($user->save())
				{
					return Redirect::route('home')
									->with('global', 'Your Password has been changed');
				}
				
			}
			return Redirect::route('account-change-password')
						->with('global','Your old password is incorrect');

		}
		return Redirect::route('account-change-password')
						->with('global','Your Password Could Not Be Changed');

	}
	public function getForgotPassword()
	{
		return View::make('account.forgot');
	}

	public function postForgotPassword()
	{
		$validator = Validator::make(Input::all(),
			array(
			'email' =>'required|email'
			)
		);

		if($validator->fails())
		{
			return Redirect::route('account-forgot-password')
					->withErrors($validator)->withInput();
		}
		else
		{
			//change password

			$user = User::where('email','=',Input::get('email'));

			if($user->count())
			{	
				$user= $user->first();
					
					//genereta the code amd the password
				$code = str_random(60);
				$password = str_random(10);
				
				$user->code = $code;			
				$user->password_temp = 	Hash::make($password);

			if($user->save())
			{
					Mail::send('emails.auth.forgot', array('link'=>URL::route('account-recover', $code), 'username'=>$user->username,'password'=>$password), function($message) use ($user) {
		 			$message->to($user->email, $user->username)->subject('Click to the link to chnage Your account password');
		 	});	

				return Redirect::route('home')->with('global','we have sent a new password by email');
			}
		}
		return Redirect::route('home')->with('global','This email is not registered with us');
		}
		}

	public function getRecover($code)
		{
			$user = User::where('code','=',$code)
						->where('password_temp','!=','');
			if($user->count())
			{
				$user= $user->first();
				$user->password = $user->password_temp;
				$user->password_temp = '';
				$user->code = '';

				if($user->save())
				{
					return Redirect::route('home')->with('global','Your Password was recoverd and you can sign in with the new password');
				}
			}

			return Redirect::route('home')->with('global', 'Could not recover your account');

		}

	public function getCreate()
	{

	 return View::make('account.create');
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), 
			array(
				'email'=>'required|max:50|email|unique:users',
				'username'=>'required|min:3|max:20|unique:users',
				'password' =>'required|min:6',
				'password_again'=>'required|same:password'
				)
			);

		if($validator->fails())
		{	
			return Redirect::route('account-create')
							->withErrors($validator)
							->withInput();
		}
		else{
			//create an user
			$email = Input::get('email');
			$username=Input::get('username');
			$password=Input::get('password');

			//Activation code
			$code = str_random(60);
			$user = User::create(array(
				'email' =>$email,
				'username'=>$username,
				'password'=>Hash::make($password),
				'code' =>$code,
				'active'=> 0
				));

			if($user){

				//send email
		Mail::send('emails.auth.activate', array('link'=>URL::route('account-activate', $code), 'username'=>$username), function($message) use ($user) {
	 		$message->to($user->email, $user->username)->subject('Activate Your account');
	 	 });	
				return Redirect::route('home')->with('global','Your account has been created, We have send you and email');
			}
		}
	}
	public function getActivate($code)
	{
		$user = User::whereCode($code)->whereActive(0);

		if($user->count()){
			$user = $user->first();

		//update user to active state

			$user->active= 1;
			$user->code = '';

			if($user->save())
			{
				return Redirect::route('home')
								->with('global','Activate!You can now sign now');

			}

		}

		return Redirect::route('home')
						->with('global', 'Sorry, We could not activate your account,Please retry again later');
	}

}