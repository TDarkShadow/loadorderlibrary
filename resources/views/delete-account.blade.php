@extends('layouts.app')

@section('title', 'Delete Account')

@section('content')
<div class="alert alert-danger text-center" role="alert">
	Warning! You are about to delete your account. This will delete your account and any lists associated with it. Be sure this is what you want to do before proceeding.</a>
</div>
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card text-white bg-dark">
			<div class="card-header">
				<h3 class="text-danger">
					Delete Account
				</h3>
			</div>

			<div class="card-body">
				<p class="card-text">Deleting your account will delete it and any lists associated with it from the database. Please ensure this is what you intend to do as it can not be undone.</p>

				<form method="POST" enctype="multipart/form-data">
					@csrf
					<button class="btn btn-danger justify-self-center" type="submit">Delete Account</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection