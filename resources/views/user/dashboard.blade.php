@section('title', 'Manage Acount')

<x-app-layout>
<h1 class="text-white">Manage Account</h1>
	<!-- Change Email Form -->

	<!-- Change Password Form -->
	<div class="my-2 row justify-content-center">
		<div class="col-md-12">
			<div class="card text-white bg-dark">
				<div class="card-header">{{ __('Change Password') }}</div>

				<div class="card-body">
					<form method="POST" action="{{ route('change-password-post') }}">
						@csrf

						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

							<div class="col-md-6">
								<input id="current" type="password" class="form-control @error('current') is-invalid @enderror" name="current" value="{{ old('name') }}" required autofocus>

								@error('current')
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

	<!-- Delete Account Form -->
	<div class="row my-2 justify-content-center">
		<div class="col-md-12">
			<div class="card text-white bg-dark">
				<div class="card-header">
					<h3 class="text-danger">
						Delete Account
					</h3>
				</div>

				<div class="card-body">
					<div class="alert alert-danger text-center" role="alert">
						Warning! You are about to delete your account. This will delete your account and any lists associated with it. Be sure this is what you want to do before proceeding.</a>
					</div>
					<p class="card-text">Deleting your account will delete it and any lists associated with it from the database. Please ensure this is what you intend to do as it can not be undone.</p>

					<form method="POST" enctype="multipart/form-data">
						@csrf
						<button class="btn btn-danger justify-self-center" type="submit">Delete Account</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>