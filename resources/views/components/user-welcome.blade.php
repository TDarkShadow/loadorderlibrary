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
				<small><em>Uploaded {{ $loadOrder->created_at->diffForHumans() }}</em></small>
				<span>
					<a class="text-danger" href="#" role="button">Delete</a>
				</span>
			</div>
		</div>
	</div>
	@empty
	<div class="col-md-6">
		<div class="card text-white bg-dark">
			<div class="card-header">
				No Lists
			</div>
			<div class="card-body">
				<p>You do not have any lists yet.</p>
			</div>
		</div>
	</div>
	@endforelse
</div>