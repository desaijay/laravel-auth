<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Jay's Profile</title>
    <meta name="description" content="Web Developer, Application Developer, Php Developer,Ecommerce developer">
    <meta name="author" content="Web application developer">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
		<script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/isotope.css') }}" media="screen" />
    <link rel="stylesheet" href="{{URL::asset('js/fancybox/jquery.fancybox.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/da-slider.css') }}" />
    <!-- Owl Carousel Assets -->
    <link href="{{ URL::asset('js/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />
    <!-- Font Awesome -->
    <link href="{{ URL::asset('font/css/font-awesome.min.css') }}" rel="stylesheet">
</head>

	<body>
	 <header class="header">
        <div class="container">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand scroll-top logo"><b>Jay's Profile</b></a>
                </div>
                <!--/.navbar-header-->
                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="mainNav">
                        <li class="active"><a href="#home" class="scroll-link">Home</a></li>
                        <li><a href="#aboutUs" class="scroll-link">About Us</a></li>
                        <li><a href="#skills" class="scroll-link">Skills</a></li>
                        <li><a href="#experience" class="scroll-link">Experience</a></li>
                        <li><a href="#" class="scroll-link">Blog</a></li>
                        <li><a href="#portfolio" class="scroll-link">Portfolio</a></li>
                        <li><a href="#contactUs" class="scroll-link">Contact Us</a></li>
                       <li><a href="{{URL::route('account-sign-in')}}">Login</a></li>

                    </ul>
                </div>
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
  
    
		@if(Session::has('global'))
		<p>{{ Session::get('global') }}</p>
		@endif
		<center>		
		@yield('content')
		</center>
		@include('layout.footer')
	