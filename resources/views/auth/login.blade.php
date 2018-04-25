@extends('layouts.app')

@section('content')
	<div class="row row-center">
		<div class="col-md-3">
			<div class="card card-center">
				<form method="POST" class="" action="{{ route('login') }}">
					@csrf
					<h2 class="text-center padding-bottom-10">Login</h2>

					<div class="text-inputs">
						<div class="group group-center">      
							<input id="email" type="email" class="" name="email" value="{{ old('email') }}" required autofocus>
							<span class="highlight"></span>
							<span class="bar"></span>
							<label>Email</label>

							@if ($errors->has('email'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>

						<div class="group">      
							<input id="password" type="password" class="" name="password" required>
							<span class="highlight"></span>
							<span class="bar"></span>
							<label>Password</label>
							<span class="forgot-password"><a class="" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a></span>
							@if ($errors->has('password'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="group">
						<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
						<label>{{ __('Remember Me') }}</label>
					</div>

					<div class="group group-center">
						<button type="submit" class="md-button">
							{{ __('Login') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>



@endsection
