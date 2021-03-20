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
				@if ($showingQrCode)
				<div>
					{!! auth()->user()->twoFactorQrCodeSvg() !!}
				</div>
				<br />
				@endif
				<div>
					<p class="text-bold">
						{{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
					</p>
					@foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
					<div>{{ $code }}</div>
					@endforeach
				</div>
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