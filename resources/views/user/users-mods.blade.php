@extends('layouts.app')

@section('content')
<div class="row row-center">
	<div class="col-md-4">
		<div class="card card-center">
			<h2>{{$username}}'s Mods</h2>
		</div>
	</div>
</div>
<div class="row row-center">
@if($loadOrders != null)
	@foreach($loadOrders[0]->loadOrder as $loadOrder)
	<div class="col-md-4">
		<a href="/lo/{{$loadOrder->slug}}">
			<div class="box card">
					<h2>{{$loadOrder->name}}</h2>
				<div class="loadorder-info">
					<div class="info">
						<div class="head">
							<p class="title"><small>{{$loadOrder->game->name}}</small></p>
							<p class="last-updated"><small><em>Updated {{$loadOrder->updated_at}}</em></small></p>
							<p class="author">By {{$loadOrder->user->username}}</p>	
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
@else
<div class="col-md-4">
		<a href="/lo/{{$loadOrder->slug}}">
			<div class="box card">
				<p>This user does not have any mod lists yet.
			</div>
		</a>
	</div>

@endif
</div>

@endsection