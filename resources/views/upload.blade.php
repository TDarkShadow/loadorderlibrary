@extends('layouts.app')

@section('title', 'Upload')

@section('content')
<div class="container">
	<div class="row justify-content-center">

		<div class="col-md-6">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Upload Files
				</div>

				<div class="card-body">
					<x-upload-form :games=$games />
				</div>
			</div>
		</div>
	</div>
	</>
	@endsection