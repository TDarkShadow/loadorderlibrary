<div class="row d-flex align-items-stretch">
	<div class="col-md-12">
		<div class="card text-white bg-dark mb-3">
			<div class="card-header d-flex justify-content-between align-items-start">
				<div class="d-flex flex-column">
					<h3><a href="/lists/{{ $loadOrder->slug }}" class="text-capitalize">{{ $loadOrder->name }}</a>
						<small>
							{{ $loadOrder->version ? 'v' . $loadOrder->version : '' }}
						</small>
					</h3>
					<small>
						by <a href="{{ $loadOrder->author ? '/lists?author=' . $loadOrder->author->name : '#' }}">{{ $loadOrder->author ? $loadOrder->author->name : 'Anonymous' }}</a>
					</small>
				</div>

				<div class="d-flex flex-column align-items-end">
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
					<a class="ml-2 btn btn-info btn-sm" href="/lists/{{$loadOrder->slug}}/edit" role="button">Edit List</a>
					@endif
					@if($loadOrder->author == auth()->user() || auth()->user()->is_admin)
					<form class="form-inline mx-2" method="POST" action="/lists/{{$loadOrder->slug}}">
						@method('delete')
						@csrf
						<button class="ml-2 btn btn-danger btn-sm" href="#" role="button">Delete List</button>
					</form>
					@endif
					@endif
					<form class="form-inline" action="/lists/{{$loadOrder->slug}}/download/all">
						@csrf
						<button class="ml-2 btn btn-info btn-sm" href="#" aria-label="download-all" role="button">Download All Files</button>
					</form>
				</div>
			</div>
		</div>


	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="accordion" id="accordion">
			@foreach($files as $file)
			<div class="accordion-item bg-dark mb-1">
				<div class="accordion-header d-flex justify-content-between align-items-center pe-3">
					<h2 class="m-0 p-0" id="heading{{$loop->index}}">
						<button class="accordion-button collapsed bg-dark text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
							<span class="text-white"><b>&plus;</b></span> <b>{{ $file['name'] }}</b>
						</button>

					</h2>
					<form class="form-inline" action="/lists/{{$loadOrder->slug}}/download/{{ $file['name'] }}">
						@csrf
						<button class="btn btn-info btn-sm" href="#" aria-label="download" role="button">Download File</button>
					</form>
				</div>
				<div id="collapse{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->index}}" data-bs-parent="#accordion">
					<div class="accordion-body text-white p-0">
						<form class="form">
							<div class="input-group">
								<span class="input-group-text" id="filter{{$loop->index}}label">Filter</span>
								<input class="form-control" type="search" placeholder="Filter..." aria-labelledby="filter{{$loop->index}}label" onkeyup="filter('filter{{$loop->index}}', 'list{{$loop->index}}')" id="filter{{$loop->index}}">
							</div>

							@if($file['name'] == 'modlist.txt')
							<div class="form-check form-switch ms-10">
								<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="toggleHidden()">
								<label class="form-check-label" for="flexCheckDefault">
									Show Disabled
								</label>
							</div>
							@endif
						</form>
						<ul class="list-group bg-dark {{ $file['name'] }}" id="list{{$loop->index}}">
							@foreach($file['content'] as $row)
							<li class="bg-dark text-white list-group-item list-group-item-dark d-flex align-items-center p-0 m-0 {{ $row['class'] }}">
								<div class="counter">
									<span>
										{{ $loop->index + 1 }}
									</span>
								</div>
								<div class="line">

									{{ $row['line'] }}
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

</div>

<script>
	const disabled = document.querySelectorAll('.list-disabled');

	function toggleHidden() {
		for (const item of disabled) {
			item.classList.toggle('list-disabled-hidden');
		}
	}

	function filter(search, list) {

		// Declare variables
		var input, filter, ul, li, a, i, txtValue;
		input = document.getElementById(search);
		filter = input.value.toLowerCase();
		ul = document.getElementById(list);
		li = ul.getElementsByTagName('li');

		// Loop through all list items, and hide those who don't match the search query

		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("div")[1];
			txtValue = a.textContent.trim() || a.innerText.trim();
			if (txtValue.toLowerCase().indexOf(filter) >= 0) {
				li[i].classList.remove('d-none');
				li[i].classList.add('d-flex');
			} else {
				li[i].classList.remove('d-flex');
				li[i].classList.add('d-none');
			}
		}
	}
</script>