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
			<div id="password-pwned" class="alert alert-danger d-none" role="alert">
				The password you are trying to use has been seen in a data breach. While <b>you can still change to it</b>, it is highly recommended not to, as it severely decreases the security of your account. Please consider using another password. This message will go away when a safe password is detected.
			</div>
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
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" onblur="checkPwned()">

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

<script>
	async function checkPwned() {
		// Get the SHA-1 hash of the password
		const password = document.getElementById('password').value;
		const msgUint8 = new TextEncoder().encode(password); // encode as (utf-8) Uint8Array
		const hashBuffer = await crypto.subtle.digest('SHA-1', msgUint8); // hash the message
		const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
		const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('').toUpperCase(); // convert bytes to hex string

		// Get both parts needed for the K-Anonimity checking
		const kAnon = hashHex.substr(0, 5);
		const checkString = hashHex.substr(5);

		// Check if the password is pwned.
		const response = await fetch(`https://api.pwnedpasswords.com/range/${kAnon}`);
		const range = await response.text();
		const pwned = range.includes(checkString);

		if (pwned) {
			const alert = document.getElementById('password-pwned');
			alert.classList.remove('d-none');
		} else {
			const alert = document.getElementById('password-pwned');
			alert.classList.add('d-none');
		}
	}
</script>