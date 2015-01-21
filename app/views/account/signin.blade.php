@extends('layout.main')

@section('content')

	<div id="box">
	<form action="{{URL::route('account-sign-in-post')}}" method="post">
		
		<div class="field">
		Email:<input type="text" id="email" name="email"{{ (Input::old('email')) ? 'value="'. Input::old('email').'"':''}}>
		@if($errors->has('email'))
			{{$errors->first('email')}}
		@endif
		</div><br>
		
		<div class="field">
		Password:<input type="password" id="password" name="password">
		@if($errors->has('password'))
			{{$errors->first('password')}}
		@endif
		</div><br>

		<div class="field">
		<input type="checkbox" name="remember" id="remember">
		<label for="remember">
			Remember Me
		</label><br>
		{{Form::token()}}		
		<input type="submit" id="submit_login" value="Submit" />
	
	</form>
	</div>

@stop