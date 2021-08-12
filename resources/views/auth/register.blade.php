@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">


	<div class="row justify-content-center">
		<div class="col-md-10">
			<div id="password-pwned" class="alert alert-danger d-flex align-items-center d-none" role="alert">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
					<use xlink:href="#exclamation-triangle-fill" />
				</svg>
				<div>
					The password you are trying to use has been seen in a data breach. While <b>you can still register with it</b>, it is highly recommended not to, as it severely decreases the security of your account. Please consider using another password. This message will go away when a safe password is detected.
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card text-white bg-dark">
				<div class="card-header">{{ __('Register') }}</div>

				<div class="card-body">
					<form method="POST" action="{{ route('register') }}">
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
							<span class="input-group-text" id="email-label">E-Mail (optional)</span>
							<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" aria-label="email" aria-describedby="email-label" autocomplete="email">

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="input-group mb-3">
							<span class="input-group-text" id="password-label">Password</span>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" aria-label="password" aria-describedby="password-label" required autocomplete="new-password" onblur="checkPwned()">

							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<div class="input-group mb-3">
							<span class="input-group-text" id="password-confirm-label">Confirm Password</span>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" aria-label="password-confirm" aria-describedby="password-confirm-label" required autocomplete="new-password">

							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>

						<button type="submit" class="btn btn-primary text-white">
							Register
						</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card text-white bg-dark">
				<div class="card-header">{{ __('On Passwords') }}</div>

				<div class="card-body">
					<p>This site uses the <a href="https://haveibeenpwned.com/API/v3" target="_blank" rel="noopener noreferrer">Have I Been Pwned? API</a> to check if passwords have been seen in a data breach. Your password itself is never sent to a third party during this check. <a href=" https://blog.cloudflare.com/validating-leaked-passwords-with-k-anonymity/" target="_blank" rel="noopener noreferrer">Read about validating leaked passwords with K-Anonimity here.</a></p>

					<p>I very much prefer giving users a choice when possible, so while I do check if a password is breached, I only notify you of it. You can still register with a breached password, though I strongly recommend against it, and recommend using a Password Manager.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

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