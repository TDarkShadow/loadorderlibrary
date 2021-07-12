@extends('layouts.app')

@section('title', 'Lists')

@section('content')
<div class="row">
	<div class="d-flex justify-content-between col-md-12">
		<h1 class="text-white">
			@if(isset($game))
			{{ $game->name }}
			@else
			All
			@endif
			Lists
			<span class="text-secondary fw-bold font-monospace p-2 fs-4">{{count($loadOrders)}}</span>
		</h1>

		<div>
			@if(preg_match('/sort=updated/', url()->full()))
			<a class="btn btn-primary text-white" href="{{ str_replace('&sort=updated', '', url()->full()) }}&sort=newest" role="button">Sort By Newest</a>
			@else
			<a class="btn btn-primary text-white" href="{{ str_replace('&sort=newest', '', url()->full()) }}&sort=updated" role="button">Sort By Updated</a>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<x-view-load-orders :loadOrders=$loadOrders />
	</div>
</div>
@endsection