@extends('layouts.app')

@section('content')
<div class="row row-center">
	@foreach($loadOrders as $loadOrder)
	<div class="col-md-4">
		<a href="/lo/{{$loadOrder->slug}}">
			<div class="box card">
				@if($loadOrder->name != null)
					<h2>{{$loadOrder->name}}</h2>
				@else
					<h2><small>Untitled</small></h2>
					
				@endif
				<div class="loadorder-info">
					<div class="info">
						<div class="head">
							<p class="title"><small>{{$loadOrder->game->name}}</small></p>
							<p class="last-updated"><small><em>Updated {{$loadOrder->updated_at}}</em></small></p>
							@if($loadOrder->user != null)
								<p class="author">By {{$loadOrder->user->username}}</p>	
							@else
								<p class="author">By Anonymous</p>	
							@endif
						</div>
			
						<div class="description">
							@if($loadOrder->description != null)
								<p class="">{{$loadOrder->description}}</p>
							@else
								<p>No description provided for Load Order</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	@endforeach	
</div>

@endsection