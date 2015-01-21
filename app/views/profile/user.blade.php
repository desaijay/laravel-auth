@extends('layout.main')

@section('content')
	<p>@if(Auth::check())
            <p>Welcome to your profile page {{Auth::user()->username}} - {{Auth::user()->email}}</p>
        @endif</p>
@stop	