@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card text-white bg-dark">
				<div class="card-header">{{ __('Enter 2FA Code') }}</div>

				<div class="card-body">
					{{ __('Please confirm your 2FA code or use a recovery code before continuing.') }}

					<form method="POST" action="/two-factor-challenge">
						@csrf

						<div class="form-group row">
							<label for="code" class="col-md-4 col-form-label text-md-right">{{ __('2FA Code') }}</label>
							<div class="col-md-6">
								<input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code">
								@error('code')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Confirm') }}
								</button>
							</div>
						</div>
					</form>

					<form method="POST" action="/two-factor-challenge">
						@csrf

						<div class="form-group row">
							<label for="recovery_code" class="col-md-4 col-form-label text-md-right">{{ __('Recovery Code') }}</label>
							<div class="col-md-6">
								<input id="recovery_code" type="text" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code">
								@error('recovery_code')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Confirm') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection