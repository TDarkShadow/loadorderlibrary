<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<!-- FB Meta -->
	<meta property="og:url" content="{{ Request::url() }}" />
	<meta property="og:title" content="Load Order Library - @yield('title')" />
	<meta property="og:description" content="@yield('description', 'A modlist files site to help with support.')" />
	<meta property="og:image" content="@yield('image', url('/images/logo.png'))" />
	<meta property="og:type" content="website" />

	<!-- Twitter Meta -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="{{ Request::url() }}">
	<meta name="twitter:title" content="Load Order Library - @yield('title')">
	<meta name="twitter:description" content="@yield('description', 'A modlist files site to help with support.')">
	<meta name="twitter:image" content="@yield('image', url('/images/logo.png'))">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Load Order Library') }} - @yield('title')</title>

	<!-- Fonts -->
	<!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

	<!-- Styles -->
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>

<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Load Order Library') }}
					<span class="badge badge-pill badge-secondary">v{{ config('app.version') }}</span>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<li>
							<a class="btn btn-secondary" href="/upload" role="button">Upload List</a>
						</li>
						<li>
							<a class="nav-link" href="/lists">Browse Lists</a>
						</li>
						<li>
							<a class="nav-link" href="/compare">Compare Lists</a>
						</li>
						<!-- Authentication Links -->
						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
						@endif
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdown">
								@if(Auth::user()->isAdmin())
								<a class="dropdown-item bg-dark text-white" href="{{ route('admin-stats') }}">
									{{ __('Stats') }}
								</a>
								@endif
								<a class="dropdown-item bg-dark text-white" href="{{ route('change-password') }}">
									{{ __('Change Password') }}
								</a>
								<a class="dropdown-item bg-dark text-danger" href="{{ route('delete-account') }}">
									{{ __('Delete Account') }}
								</a>
								<div class="dropdown-divider bg-dark"></div>
								<a class="dropdown-item bg-dark text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>
		@if(config('app.env') == 'testing')
		<div class="alert alert-danger text-center" role="alert">
			You are on the testing site! This version uses a completely separate database and stuff will be deleted/break. <a class="alert-link" href="https://loadorderlibrary.com">Return To Main Site</a>
		</div>
		@endif
		<main class="py-4">
			<div class="container">
				@include('flash::message')
				@yield('content')
			</div>
		</main>

		<footer>
			<div class="container">
				<div class="row justify-content-center text-white">
					<p>
						Load Order Library &copy; 2021 Phinocio
					</p>

				</div>
				<div class="row justify-content-center text-white">
					<p>
						<a href="https://github.com/phinocio/loadorderlibrary/issues/new" target="_blank" rel="noopener noreferrer">Create Github Issue</a> |
						<a href="https://github.com/phinocio/loadorderlibrary" target="_blank" rel="noopener noreferrer">Github</a> |
						<a href="https://discord.gg/K3KnEgrQE4" target="_blank" rel="noopener noreferrer">Discord</a> |
						<a href="https://www.reddit.com/r/LoadOrderLibrary/" target="_blank" rel="noopener noreferrer">Reddit</a> |
						<a href="https://www.patreon.com/phinocio" target="_blank" rel="noopener noreferrer">Patreon</a>
					</p>
				</div>
			</div>
		</footer>
	</div>
	<script src="{{ mix('/js/manifest.js') }}"></script>
	<script src="{{ mix('/js/vendor.js') }}"></script>
	<script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>