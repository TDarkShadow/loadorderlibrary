@extends('layouts.app')

@section('content')
<div class="row justify-content-center">

	<div class="col-md-12">
		<h1 class="text-white">Results </h1>
		<small class="text-white">Results only show differences between files that exist in both lists, and have differences between them.</small>
		<x-compare-load-orders-results :results=$results />
	</div>
</div>
@endsection