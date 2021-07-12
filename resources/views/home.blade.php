@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		@if(Auth::check())
		<h1 class="text-white">Your Lists <span class="text-secondary fw-bold font-monospace p-2 fs-4">{{count($loadOrders)}}</span></h1>
		<x-view-load-orders :loadOrders=$loadOrders />
		@else
		<x-guest-welcome />
		@endif
	</div>
</div>
@endsection