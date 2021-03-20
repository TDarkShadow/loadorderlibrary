<div class="row d-flex align-items-stretch">
	@forelse($loadOrders as $loadOrder)
	<div class="col-md-6 card-group">
		<div class="mb-3 card text-white bg-dark">
			<div class="card-header d-flex justify-content-between align-items-start">
				<div class="d-flex flex-column">
					<strong><a href="/lists/{{ $loadOrder->slug }}" class="text-capitalize">{{ $loadOrder->name }}</a></strong>
					<small>
						by <a href="{{ $loadOrder->author ? '/lists?author=' . $loadOrder->author->name : '#' }}">{{ $loadOrder->author ? $loadOrder->author->name : 'Anonymous' }}</a>
					</small>
				</div>

				<div class="d-flex flex-column">
					<small>
						<em><a class="game-link" href="/lists?game={{ $loadOrder->game->name }}">{{ $loadOrder->game->name }}</a></em>
					</small>
					@if($loadOrder->is_private)
					<small class="display-block text-muted">
						<em>
							Private List
						</em>
					</small>
					@endif
				</div>
			</div>

			<div class="card-body">
				{!! \App\Helpers\LinkParser::parse($loadOrder->description ?? 'No description provided.') !!}
			</div>

			<div class="card-footer text-muted d-flex justify-content-between align-items-center">
				<div class="d-flex flex-column">
					<small>Updated {{ $loadOrder->updated_at->diffForHumans() }}</small>
					<small>Uploaded {{ $loadOrder->created_at->diffForHumans() }}</small>
				</div>
				<div class="d-flex">
					@if(auth()->check())
					@if($loadOrder->author == auth()->user())
					<a class="ml-2 btn btn-outline-info btn-sm" href="/lists/{{$loadOrder->slug}}/edit" role="button">Edit List</a>
					@endif
					@if($loadOrder->author == auth()->user() || auth()->user()->is_admin)
					<form class="form-inline" method="POST" action="/lists/{{$loadOrder->slug}}">
						@method('delete')
						@csrf
						<button class="ml-2 btn btn-outline-danger btn-sm" href="#" role="button">Delete List</button>
					</form>
					@endif
					@endif
				</div>
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