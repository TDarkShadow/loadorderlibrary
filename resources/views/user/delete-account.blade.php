@extends('layouts.app')

@section('content')
	<div class="row row-center">
		<div class="col-md-5">
			<div class="card">
				<h2>Delete Your Account?</h2>
				<p>You are about to permanently delete your account! All Load Orders associated with your account will also be deleted. Are you sure?</p>


				<form method="POST" action="/u/{{Auth::user()->username}}/delete-account">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<button type="submit" class="md-button button-red">Delete my Account</button>
					<a href="/"><button type="button" class="md-button">No! Go Back!</button></a>
				</form>
			</div>
		</div>
	</div>
@endsection