<div class="row d-flex align-items-stretch">
	@forelse($loadOrders as $loadOrder)
	<div class="col-md-4 card-group">
		<div class="mb-3 card text-white bg-dark">
			<div class="card-header d-flex justify-content-between align-items-center">
				<strong><a href="#" class="text-capitalize">{{ $loadOrder->name }}</a></strong>
				<small><em>{{ $loadOrder->game->name }}</em></small>
			</div>

			<div class="card-body">
				{{ $loadOrder->description }}
			</div>

			<div class="card-footer text-muted d-flex justify-content-between align-items-center">
				<small><em>Uploaded {{ $loadOrder->created_at->diffForHumans() }} by {{ $loadOrder->user->name }}</em></small>
				<span>
					<form method="POST" action="/loadOrders/{{$loadOrder->slug}}">
						@method('delete')
						@csrf
						<button class="btn text-danger" href="#" role="button">Delete</button>
					</form>
				</span>
			</div>
		</div>
	</div>
	@empty
	<div class="col-md-6">
		<div class="card text-white bg-dark">
			<div class="card-header">
				No Load Orders
			</div>
			<div class="card-body">
				<p>There are no load orders to display.</p>
			</div>
		</div>
	</div>
	@endforelse
</div>