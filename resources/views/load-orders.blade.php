@extends('layouts.app')

@section('title', 'Lists')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		<h1 class="text-white">
			@if(isset($game))
				{{ $game->name }}
			@else
				All
			@endif
			Lists
		</h1>

		<x-view-load-orders :loadOrders=$loadOrders />
	</div>
</div>
@endsection