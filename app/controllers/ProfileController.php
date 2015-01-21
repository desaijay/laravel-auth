<?php

class ProfileController extends BaseController
{
	public function user($username)
	{
		$user = User::whereUsername($username);

		if($user->count()){
			$user = $user->first();
		return View::make('profile.user')->with('user', $user);
	}
	else{
		return View::make('profile.user')->with('global', '404 error page');
	}
	return App::abort(404);
	}
}