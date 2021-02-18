@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		@if(Auth::check())
		<h1 class="text-white">Your Load Orders</h1>
		<x-view-load-orders :loadOrders=$loadOrders />
		@else
		<x-guest-welcome />
		@endif
	</div>
</div>
@endsection