@extends('layouts.app')

@section('title', $loadOrder['name'])

@section('description', $loadOrder['name'] . ' for ' . $loadOrder['game']->name . ' by ' $loadOrder->author ? $loadOrder->author->name : 'Anonymous' )

@section('content')
<div class="row justify-content-center">
	<div class="col-md-12">
		<x-view-load-order :loadOrder=$loadOrder :files=$files />
	</div>
</div>
@endsection