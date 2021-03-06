@extends('layouts.app')

@section('title', 'Upload')

@section('content')
<div class="container">
	<div class="row justify-content-center">

		<div class="col-md-8 card-group">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Upload Files
				</div>

				<div class="card-body">
					<x-upload-form :games=$games />
				</div>
			</div>
		</div>
		<div class="col-md-4 card-group">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Valid Files
				</div>

				<div class="card-body p-0">
					<ul class="list-group bg-dark">
						@foreach($validFiles as $file)
						<li class="bg-dark text-white list-group-item list-group-item-dark d-flex py-1">
							{{$file}}
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
	</>
	@endsection