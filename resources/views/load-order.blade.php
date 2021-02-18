@extends('layouts.app')

@section('title', $loadOrder['name'])

@section('description', 'A list for ' . $loadOrder['game']->name . ' by ' . $author)

@section('image', url('/images/' . $loadOrder->game->name . '.png'))

@section('content')
<div class="row justify-content-center">
	<div class="col-md-12">
		<x-view-load-order :loadOrder=$loadOrder :files=$files />
	</div>
</div>
@endsection