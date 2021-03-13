@extends('layouts.app')

@section('title', 'Edit ' . $loadOrder['name'])

@section('image', url('/images/' . $loadOrder->game->name . '.png'))

@section('content')
<div class="row justify-content-center">
	<div class="col-md-12">
		<x-edit-load-order :loadOrder=$loadOrder />
	</div>
</div>
@endsection