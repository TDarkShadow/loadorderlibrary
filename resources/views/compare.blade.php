@extends('layouts.app')

@section('title', 'Compare Lists')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		<h1 class="text-white">Compare Load Orders (BETA)</h1>
		
		<x-compare-load-orders :loadOrders=$loadOrders />
	</div>
</div>
@endsection