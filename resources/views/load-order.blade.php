@extends('layouts.app')

@section('title', $loadOrder['name'])

@section('content')
<div class="row justify-content-center">
	<div class="col-md-12">
		<x-view-load-order :loadOrder=$loadOrder :files=$files />
	</div>
</div>
@endsection