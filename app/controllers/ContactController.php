<?php

class ContactController extends BaseController
{
	public function getContact()
	{
		return View::make('neu');

	}

	public function contact()
	{
		$validator = Validator::make(Input::all(),array(
			'name'=>'required',
			'email' =>'required|email',
			'message'=>'required'
			));

		if($validator->fails())
		{
			return Redirect::route('neu-home')->withErrors($validator)->withInput();
		}
		else
		{
			$contact = new Contact();
			$contact->name = Input::get('name');
			$contact->email = Input::get('email');
			$contact->message = nl2br(Input::get('message'));

			if($contact->save())
				{
					
					return Redirect::route('home')
									->with('global', 'Your Message has been sent');
				}
				else
					{
						return Redirect::route('home')
									->with('global', 'Your Message has not been sent');

					}
		}

	}
}