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

					<div class="nav-menu">
						<ul>
							<li><h2><a href="">Upload</a></h2></li>
							<li><h2><a href="/login">Login </a> | <a href="/register">Register</a></h2></li>
							@if(Auth::check())
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
										@csrf
										<button type="submit">Logout</button>
                                    </form>
							@endif
						</ul>
					</div>
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

		
    </body>
</html>
