@extends('layouts.app')

@section('title', 'Compare Lists')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		<h1 class="text-white">Compare Load Orders (BETA) - DISABLED</h1>
		<div class="card text-white bg-dark">
			<div class="card-header">
				Comparison Disabled
			</div>
			<div class="card-body">
				<p>Comparison is currently disabled as I fix an issue that was making results completely inaccurate, and therefore effectively useless.</p>
			</div>
		</div>
		<!-- <x-compare-load-orders :loadOrders=$loadOrders /> -->
	</div>
</div>
@endsection