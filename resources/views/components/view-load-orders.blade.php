<div class="row d-flex align-items-stretch">
	<div class="row m-0 p-0 pb-3">
		<div class="input-group">
			<input class="form-control" type="search" placeholder="Filter Lists..." aria-labelledby="filter1label" onkeyup="filter('filter1')" id="filter1">
		</div>
	</div>
	@forelse($loadOrders as $loadOrder)
	<div class="col-md-6 card-group">
		<div class="mb-3 card text-white bg-dark">
			<div class="card-header d-flex justify-content-between align-items-start">
				<div class="d-flex flex-column">
					<strong><a href="/lists/{{ $loadOrder->slug }}" class="text-capitalize">{{ $loadOrder->name }}</a>
						<small>
							{{ $loadOrder->version ? 'v' . $loadOrder->version : '' }}
						</small>
					</strong>

					<small>
						by <a href="{{ $loadOrder->author ? '/lists?author=' . $loadOrder->author->name : '#' }}">{{ $loadOrder->author ? $loadOrder->author->name : 'Anonymous' }}
							@if($loadOrder->author?->is_verified)
							<x-icons.verified />
							@endif
						</a>
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
				{!! mb_strimwidth(\App\Helpers\LinkParser::parse($loadOrder->description ?? 'No description provided.'), 0, 300, '...') !!}

				@if($loadOrder->website)
					<br />
					<a href="https://{{ $loadOrder->website }}" target="_blank" rel="noopener noreferrer">{{ $loadOrder->website }}
						<x-icons.external-site />
					</a>
				@endif
			</div>

			<div class="card-footer text-muted d-flex justify-content-between align-items-center">
				<div class="d-flex flex-column">
					<small title="{{$loadOrder->updated_at->format('Y-m-d H:i:s T')}}">Updated {{ $loadOrder->updated_at->diffForHumans() }}</small>
					<small title="{{$loadOrder->created_at->format('Y-m-d H:i:s T')}}">Uploaded {{ $loadOrder->created_at->diffForHumans() }}</small>
				</div>
				<div class="d-flex">
					@if(auth()->check())
					@if($loadOrder->author == auth()->user())
					<a class="ml-2 btn btn-secondary btn-sm text-white" href="/lists/{{$loadOrder->slug}}/edit" role="button">Edit List</a>
					@endif
					@if($loadOrder->author == auth()->user() || auth()->user()->is_admin)
					<form class="form-inline ms-2" method="POST" action="/lists/{{$loadOrder->slug}}">
						@method('delete')
						@csrf
						<button class="ml-2 btn btn-danger btn-sm" href="#" role="button">Delete List</button>
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
</div>

<script>
	function filter(search, list) {

		// Declare variables
		var input, filter, ul, li, a, i, headerText, bodyText;
		input = document.getElementById(search);
		filter = input.value.toLowerCase();
		lists = document.getElementsByClassName('card-group');

		// Loop through all list items, and hide those who don't match the search query

		for (i = 0; i < lists.length; i++) {
			a = lists[i].getElementsByTagName("div")[1];

			console.log();

			headerText = a.innerText.trim();
			bodyText = a.nextElementSibling.innerText.trim();

			if (headerText.toLowerCase().indexOf(filter) >= 0 || bodyText.toLowerCase().indexOf(filter) >= 0) {
				lists[i].classList.remove('d-none');
				lists[i].classList.add('d-flex');
			} else {
				lists[i].classList.remove('d-flex');
				lists[i].classList.add('d-none');
			}
		}
	}
</script>