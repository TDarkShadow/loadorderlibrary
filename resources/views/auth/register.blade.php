@extends('../layouts.app')

@section('content')
	<div class="row row-center">
		<div class="col col-4 card card-center">
			
			<form method="POST" class="" action="{{ route('register') }}">
				@csrf
				<h2 class="text-center padding-bottom-10">Register Account</h2>

				<div class="text-inputs">
					<div class="group">      
						<input id="username" type="text" class="" name="username" value="{{ old('username') }}" required autofocus>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label>Username</label>
						@if ($errors->has('username'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
						@endif
					</div>

					<div class="group">      
						<input id="email" type="email" class="" name="email" value="{{ old('email') }}" required>
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

						@if ($errors->has('password'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>

					<div class="group">      
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label>Confirm Password</label>
					</div>
				</div>

				<div class="group group-center">
					<button type="submit" class="md-button">
						{{ __('Register') }}
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection