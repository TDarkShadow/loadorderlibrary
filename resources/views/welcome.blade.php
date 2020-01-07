@extends('layouts.app')

@section('content')
<div class="row row-center">
	@if(!Auth::check())
	<div class="col-md-8">
		@include('layouts/partials/guest/guest-welcome')
	</div>
	<div class="col-md-4">
		@include('components/comparison')
	</div>
	@endif
</div>

<div class="row row-center">
	@if(Auth::check())
	<div class="col-md-8">
		@include('layouts/partials/user/user-mods-quick-look')
	</div>
	<div class="col-md-4">
		@include('components/comparison')
	</div>
	@endif
</div>
@endsection