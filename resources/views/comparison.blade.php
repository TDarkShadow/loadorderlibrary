@extends('layouts.app')

@section('content')
<div class="row row-center">
	@if(!Auth::check())
	<div class="col-md-8">
		<div class="box card">
			<h1>Missing!</h1>
			@foreach(array_keys($missing) as $key)
			<h2>{{$key}}</h2>
			<ul>
				@foreach($missing[$key] as $missed)
				<li>{{$missed}}</li>
				@endforeach
			</ul>
			@endforeach
		</div>
		@endif
	</div>
</div>
@endsection