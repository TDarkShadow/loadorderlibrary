@extends('layouts.app')

@section('content')
<div class="row row-center">
		<div class="col-md-3">
			<div class="card card-center">
				<form method="POST" class="" action="{{ route('password.email') }}">
					@csrf
					<h2 class="text-center padding-bottom-10">Reset Password</h2>

					<div class="text-inputs">
						<div class="group group-center">      
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
					</div>

					<div class="group group-center">
						<button type="submit" class="md-button">
							{{ __('Send Reset Link') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
