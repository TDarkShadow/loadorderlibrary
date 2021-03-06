<div class="row d-flex align-items-stretch">
	@forelse($loadOrders as $loadOrder)
	<div class="col-md-6 card-group">
		<div class="mb-3 card text-white bg-dark">
			<div class="card-header d-flex justify-content-between align-items-center">
				<div>
					<strong><a href="/lists/{{ $loadOrder->slug }}" class="text-capitalize">{{ $loadOrder->name }}</a></strong>
					@if($loadOrder->is_private)
					<small class="display-block text-muted">
						<em>
							Private List
						</em>
					</small>
					@endif
				</div>

				<small>

					<em>{{ $loadOrder->game->name }}</em>
				</small>
			</div>

			<div class="card-body">
				{{ $loadOrder->description ?? 'No description provided' }}
			</div>

			<div class="card-footer text-muted d-flex justify-content-between align-items-center">
				<small>Uploaded {{ $loadOrder->created_at->diffForHumans() }} by <a href="#">{{ $loadOrder->author ? $loadOrder->author->name : 'Anonymous' }}</a></small>
				@if(auth()->check())
				@if($loadOrder->author == auth()->user() || auth()->user()->is_admin)
				<span>
					<form method="POST" action="/lists/{{$loadOrder->slug}}">
						@method('delete')
						@csrf
						<button class="btn text-danger" href="#" role="button">Delete</button>
					</form>
				</span>
				@endif
				@endif
			</div>
		</div>
	</div>
	@empty
	<div class="col-md-12">
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
	<div class="col-md-12 mt-3">
		{{ $loadOrders->links() }}
	</div>
</div>