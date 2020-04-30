@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">

		<div class="col-md-6">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Upload Files
				</div>

				<div class="card-body">
					@if(Auth::check())
					<x-user-upload-form :games=$games />
					@else
					<!-- Guest Form -->
					@endif
				</div>
			</div>
		</div>
	</div>
	</>
	@endsection