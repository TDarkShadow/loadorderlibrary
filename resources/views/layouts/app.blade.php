<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		@section('title')
			<title>Load Order Library</title>
		@show

		<!-- Styles -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
    </head>
    <body>
		
		@section('nav')
			<div class="wrapper">
				<nav class="nav">
					<div class="nav-logo">
						<a href="/"><h2>Load Order Library</h2></a>
					</div>

					<!-- TODO: Extract the nav-menu to be in two differnt partials for guest and logged in -->

					@if(Auth::check())
						@include('layouts.partials.nav.user')
					@else
						@include('layouts.partials.nav.guest')
					@endif
				</nav>
			</div>
		@show

		<div class="container">
			@yield('content')
		</div>

		@section('footer')
			<div class="footer">
				<p class="footer-text">Created by Phinocio | <a href="https://github.com/phinocio/loadorderlibrary">Github</a></p>
			</div>
		@show

		<script src="{{ mix('js/app.js') }}">
    </body>
</html>
