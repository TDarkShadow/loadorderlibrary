@section('title', 'Register')

<x-guest-layout>
	<div class="container">
		<div id="password-pwned" class="alert alert-danger d-none" role="alert">
			The password you are trying to use has been seen in a data breach. While <b>you can still register with it</b>, it is highly recommended not to, as it severely decreases the security of your account. Please consider using another password.
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card text-white bg-dark">
					<div class="card-header">{{ __('Register') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('register') }}">
							@csrf

							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address (optional)') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
										{{ __('Register') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card text-white bg-dark">
					<div class="card-header">{{ __('On Passwords') }}</div>

					<div class="card-body">
						<p>This site used the <a href="https://haveibeenpwned.com/API/v3" target="_blank" rel="noopener noreferrer">Have I Been Pwned? API</a> to check if passwords have been seen in a data breach. Your password itself is never sent to a third party during this check. <a href=" https://blog.cloudflare.com/validating-leaked-passwords-with-k-anonymity/" target="_blank" rel="noopener noreferrer">Read about validating leaked passwords with K-Anonimity here.</a></p>

						<p>I very much prefer giving users a choice when possible, so while I do check if a password is breached, I only notify you of it. You can still register with a breached password, though I strongly recommend against it, and recommend using a Password Manager.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-guest-layout>

<script>
	async function checkPwned() {

		// Get the SHA-1 hash of the password
		const password = document.getElementById('password').value;
		const msgUint8 = new TextEncoder().encode(password); // encode as (utf-8) Uint8Array
		const hashBuffer = await crypto.subtle.digest('SHA-1', msgUint8); // hash the message
		const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
		const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('').toUpperCase(); // convert bytes to hex string

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