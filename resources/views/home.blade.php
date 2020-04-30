@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">

		<div class="col-md-8">
			@if(Auth::check())
			<x-user-welcome :loadOrders=$loadOrders />
			@else
			<x-guest-welcome />
			@endif
		</div>

		<div class="col-md-4">
			<div class="card text-white bg-dark">

				<div class="card-header">
					Compare A List
				</div>

				<div class="card-body">
					body
				</div>
			</div>
		</div>
	</div>
@endsection