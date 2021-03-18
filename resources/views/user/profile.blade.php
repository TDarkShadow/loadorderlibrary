@extends('layouts.app')

@section('title', 'Manage Account')

@section('content')
<h1 class="text-white">Manage Account</h1>
<!-- Change Email Form -->
<div class="my-2 row justify-content-center">
	<div class="col-md-12">
		<div class="card text-white bg-dark">
			<div class="card-header">
				{{ __('Change Email') }}
				<small class="text-muted">To remove an email, just click "change email" without entering anything.</small>
			</div>

			<div class="card-body">
				<form method="POST" action="/user/profile-information">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label for="current-email" class="col-md-4 col-form-label text-md-right">{{ __('Current Email') }}</label>

						<div class="col-md-6">
							<input id="current-email" type="email" class="form-control" name="current-email" required autocomplete="new-current-email" value="{{ auth()->user()->email ?? 'no email set' }}" disabled>
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('New Email') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Change Email') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Change Password Form -->
<div class="my-2 row justify-content-center">
	<div class="col-md-12">
		<div class="card text-white bg-dark">
			<div class="card-header">{{ __('Change Password') }}</div>

			<div class="card-body">
				<form method="POST" action="/user/password">
					@csrf
					@method('PUT')

					<div class="form-group row">
						<label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

						<div class="col-md-6">
							<input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>

							@error('current_password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Change Password') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Enable 2FA Form -->
<div class="my-2 row justify-content-center">
	<div class="col-md-12">
		@if(auth()->user()->enabledTwoFactor())
		<div class="card text-white bg-dark">
			<div class="card-header">{{ __('Disable 2FA') }}</div>

			<div class="card-body">
				@if (session('status') == 'two-factor-authentication-disabled')
				<div class="mb-4 font-medium text-sm text-green-600">
					Two factor authentication has been disabled.
				</div>
				@endif

				{!! auth()->user()->twoFactorQrCodeSvg() !!}
				@foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
				<div>{{ $code }}</div>
				@endforeach
				<form method="POST" action="/user/two-factor-authentication">
					@csrf
					@method('DELETE')

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Disable 2FA') }}
							</button>
						</div>
					</div>
				</form>
				<form method="POST" action="/user/two-factor-recovery-codes">
					@csrf

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Regenerate Codes') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		@else
		<div class="card text-white bg-dark">
			<div class="card-header">{{ __('Enable 2FA') }}</div>

			<div class="card-body">
				@if (session('status') == 'two-factor-authentication-enabled')
				<div class="mb-4 font-medium text-sm text-green-600">
					Two factor authentication has been enabled.
				</div>
				@endif
				<form method="POST" action="/user/two-factor-authentication">
					@csrf

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Enable 2FA') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		@endif
	</div>
</div>


<!-- Delete Account Form -->
<div class="row my-2 justify-content-center">
	<div class="col-md-12">
		<div class="card text-white bg-dark">
			<div class="card-header text-danger">
				Delete Account
			</div>

			<div class="card-body">
				<p class="card-text">Deleting your account will delete it and any lists associated with it from the database. Please ensure this is what you intend to do as it can not be undone.</p>

				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccount">
					Delete Account
				</button>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Delete account confirmation modal -->

<div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="deleteAccountLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="deleteAccountLabel">Delete Account</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Deleting your account will delete it and any lists associated with it from the database. Please ensure this is what you intend to do as it can not be undone.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<form method="POST" action="{{ route('user.delete-account') }}">
					@csrf
					<button class="btn btn-danger justify-self-center" type="submit">Delete Account</button>
				</form>
			</div>
		</div>
	</div>
</div>