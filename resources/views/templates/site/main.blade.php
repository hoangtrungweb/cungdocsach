<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{!! csrf_token() !!}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('assets/site/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/site/css/font-awesome.min.css')}}">
	 <link href="{{asset('assets/site/material/css/roboto.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/material/css/material.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/material/css/ripples.min.css')}}" rel="stylesheet">
	
	<!-- quotes -->

	<link rel="stylesheet" type="text/css" href="{{asset('assets/site/quotesrotator/css/component.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/sweetalert/sweetalert.css')}}">

	@yield('head.css')

	<script src="{{asset('assets/site/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{asset('assets/site/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/site/material/js/ripples.min.js')}}"></script>
    <script src="{{asset('assets/site/material/js/material.min.js')}}"></script>
    <script src="{{asset('assets/site/quotesrotator/js/modernizr.custom.js')}}"></script>
    <script src="{{asset('assets/site/quotesrotator/js/jquery.cbpQTRotator.min.js')}}"></script>
    <script src="{{asset('assets/sweetalert/sweetalert.min.js')}}"></script>

    @yield('head.script')

    @yield('head.styleinline')
</head>
<body class="">
	@include('partials.header')
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					@yield('body.content')
				</div>

				<div class="col-md-3">
					@include('partials.sidebar')
				</div>

			</div>
		</div>


@include('partials.footer')
	

	
<script type="text/javascript">
			$( function() {
				/*
				- how to call the plugin:
				$( selector ).cbpQTRotator( [options] );
				- options:
				{
					// default transition speed (ms)
					speed : 700,
					// default transition easing
					easing : 'ease',
					// rotator interval (ms)
					interval : 8000
				}
				- destroy:
				$( selector ).cbpQTRotator( 'destroy' );
				*/

				$( '#cbp-qtrotator' ).cbpQTRotator(
					
				);

			} );
</script>	

 @yield('body.script')
</body>
</html>