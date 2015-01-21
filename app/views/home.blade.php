@extends('layout.main')

@section('content')
	@if(Auth::check())
	<p>Hello {{Auth::user()->username }}</p>
	@else
	 Please Sign In

	@endif
@stop
