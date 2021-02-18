@extends('layouts.app')

@section('title', 'Lists')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		<h1 class="text-white">Load Orders</h1>
		<x-view-load-orders :loadOrders=$loadOrders />
	</div>
</div>
@endsection