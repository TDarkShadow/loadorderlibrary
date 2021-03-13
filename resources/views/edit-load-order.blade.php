@extends('layouts.app')

@section('title', 'Edit ' . $loadOrder['name'])

@section('image', url('/images/' . $loadOrder->game->name . '.png'))

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 card-group">
			<div class="card text-white bg-dark">
				<div class="card-header text-center">
					Edit List
				</div>

				<div class="card-body">
					<x-edit-load-order-form :loadOrder=$loadOrder :games=$games />
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
</div>
@endsection