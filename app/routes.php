<?php

Route::get('/', array('as'=>'home', 'uses'=>'HomeController@home'));

Route::get('user/{username}', array('as'=>'profile-user', 'uses'=>'ProfileController@user'));


/*
// authenticated group
*/

Route::group(array('before'=>'auth'), function(){


	/*
	CSRF prtection group

	*/

	Route::group(array('before'=>'csrf'), function(){


		Route::post('/account/change-password', array(
			
			'as'=>'account-change-password-post',
			'uses'=>'AccountController@postChangePassword'

			));



	});




	/*
	// Sign Out(GET)
	==
	*/

	Route::get('/account/sign-out', array('as' => 'account-sign-out', 
		'uses'=>'AccountController@getSignOut' ));

	/*
	change password 
	*/
	Route::get('/account/change-password', 
		array(
		'as'=>'account-change-password', 
		'uses'=> 'AccountController@getChangePassword'
		));


});






/*
unauthenticated group
*/
Route::group(array('before' =>'guest'), function(){

		/*
		Crossite request forgery 
		*/
	Route::group(array('before'=>'csrf'), function(){

		/*
	//create account(
	post)
	*/
	Route::post('/account/create', array(
		'as' => 'account-create-post',
		'uses'=> 'AccountController@postCreate'

		));

	//sign in post
	Route::post('/account/sign-in', array(
		'as' => 'account-sign-in-post',
		'uses'=> 'AccountController@postSignIn'

		));
/*
	//forgot-paasword (POST)
	*/
	Route::post('/account/forgot-password-post', array(
		'as' => 'forgot-password-post',
		'uses'=> 'AccountController@postForgotPassword'

		));


	});

/*
	//forgot-paasword (GET)
	*/
	Route::get('/account/forgot-password', array(
		'as' => 'account-forgot-password',
		'uses'=> 'AccountController@getForgotPassword'

		));

	/*
	//sign in (GET)
	*/
	Route::get('/account/sign-in', array(
		'as' => 'account-sign-in',
		'uses'=> 'AccountController@getSignIn'

		));


	/*
	//create account(GET)
	*/
	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses'=> 'AccountController@getCreate'

		));

	//recover password

	Route::get('/account/recover/{code}', array(

		'as' => 'account-recover',
		'uses'=> 'AccountController@getRecover'
		));


	Route::get('/account/activate/{code}',array(
		'as' =>'account-activate',
		'uses'=>'AccountController@getActivate'

		));

});

Route::get('/neu', array('as'=>'neu-home', 'uses'=>'ContactController@getContact'));

Route::post('/neu', array('as'=>'contact-me', 'uses'=>'ContactController@contact'));