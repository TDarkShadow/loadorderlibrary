@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="alert alert-info d-flex align-items-center" role="alert">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
					<use xlink:href="#info-fill" />
				</svg>
				<div>
					Email is now optional. Use your name to login. You can remove your email on the account management page.
				</div>
			</div>

			<div class="card text-white bg-dark">
				<h4 class="card-header">Login</h4>
				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="input-group mb-3">
							<span class="input-group-text" id="name-label">Name</span>
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" aria-label="Name" aria-describedby="name-label" required autocomplete="name" autofocus>

							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="input-group mb-3">
							<span class="input-group-text" id="password-label">Password</span>
							<input id="password" type="password" class="form-control @error('name') is-invalid @enderror" name="password" value="{{ old('name') }}" aria-label="Password" aria-describedby="password-label" required>

							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="input-group mb-3">
							<div class="col-md-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

									<label class="form-check-label" for="remember">
										Remember Me
									</label>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary text-white">
							Login
						</button>
						@if (Route::has('password.request'))
						<a class="btn btn-link" href="{{ route('password.request') }}">
							Forgot Your Password?
						</a>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection