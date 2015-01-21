@extends('layout.main')

@section('content')

		<form action="{{ URL::route('forgot-password-post') }}" method="post">
			Email: <input type="text" name="email"{{(Input::old('email')) ? 'value="' .e(Input::old('email')). '"':'' }}>
			@if($errors->has('email'))
			{{	$errors->first('email')	}}
			@endif
			{{Form::token()}}
			<input type="submit" value="Recover">
			
		</form>
	
@stop