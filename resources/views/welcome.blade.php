@extends('layouts.app')

@section('content')
<div class="row row-center">
	@if(!Auth::check())
		<div class="col-md-8">
			@include('layouts/partials/guest/guest-welcome')
		</div>
	@endif
</div>

<div class="row row-center">
	@if(Auth::check())
		<div class="col-md-8">
			@include('layouts/partials/user/user-mods-quick-look')
		</div>
	@endif
</div>
@endsection