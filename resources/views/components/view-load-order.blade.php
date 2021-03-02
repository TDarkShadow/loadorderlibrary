<div class="row d-flex align-items-stretch">
	<div class="col-md-12">
		<div class="card text-white bg-dark mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h3><strong><a href="/lists/{{ $loadOrder->slug }}" class="text-capitalize">{{ $loadOrder->name }}</a></strong></h3>
				<small><em><a href="#">{{ $loadOrder->game->name }}</a></em></small>
			</div>
			<div class="card-body">
				{{ $loadOrder->description ?? 'No description provided.'}}
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
</div>
<div class="row">
	<div class="col-md-12">
		<div class="accordion" id="accordion">
			@foreach($files as $file)
			<div class="card bg-dark col-md-12 mb-1 p-0">
				<div class="card-header d-flex justify-content-between align-items-center m-0 pl-0" id="heading{{$loop->index}}">
					<h5 class="mb-0">
						<button class="ml-1 btn btn-link collapsed inline" type="button" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
							<span class="text-white">&#11166;</span> <b>{{ $file['name'] }}</b>
						</button>
					</h5>

					<form class="form-inline my-2 my-lg-0">
						@if($file['name'] == 'modlist.txt')
						<div class="custom-control custom-switch mr-2">
							<input type="checkbox" class="custom-control-input" id="customSwitch1" onclick="toggleHidden()">
							<label class="custom-control-label text-white" for="customSwitch1">Show Disabled</label>
						</div>
						@endif
						<input class="form-control mr-sm-2" type="search" placeholder="Filter..." aria-label="Filter" onkeyup="filter('filter{{$loop->index}}', 'list{{$loop->index}}')" id="filter{{$loop->index}}">
					</form>
				</div>

				<div id="collapse{{$loop->index}}" class="collapse" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion">
					<div class="card-body bg-dark m-0 p-0">
						<ul class="list-group bg-dark {{ $file['name'] }}" id="list{{$loop->index}}">
							@foreach($file['content'] as $row)
								<li class="bg-dark text-white list-group-item-dark d-flex align-items-center p-0 m-0 {{ $row['class'] }}">
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
		console.log(disabled);

		disabled[0].classList.toggle('list-disabled-hidden');
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