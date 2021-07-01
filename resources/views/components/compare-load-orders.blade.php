<div class="row d-flex align-items-stretch">
	<div class="col-md-12">
		<div class="card text-white bg-dark">
			<div class="card-header">
				Compare list 1 with list 2 to see if list 1 is missing anything, or has any extra entries.
			</div>
			<form method="POST">
				@csrf
				<div class="card-body d-flex justify-content-between compare-choose">
					<div class="list1">
						@error('list1')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="input-group">
							<span class="input-group-text" id="filter1label">Filter</span>
							<input class="form-control" type="search" placeholder="Filter..." aria-labelledby="filter1label" onkeyup="filter('filter1', 'list1')" id="filter1">
						</div>
						<ul class="list-group bg-dark mt-2" id="list1">
							@foreach($loadOrders as $list)
							<label for="list1-{{ $list->id }}">
								<li class="bg-dark text-white list-group-item list-group-item-dark my-1 d-flex align-items-center">
									<input class="compare-radio" type="radio" name="list1" id="list1-{{ $list->id }}" value="{{ $list->slug }}">
									<span class="compare-checkbox"></span>
									<div class="list-info">
										<h4><a href="/lists/{{ $list->slug }}">{{ $list->name }}</a></h4>
										<span>by <b>{{ $list->author ? $list->author->name : 'Anonymous' }}</b></span>
									</div>
								</li>
							</label>
							@endforeach
						</ul>
					</div>
					<div class="d-flex justify-content-around align-self-start compare">
						<button type="submit" class="btn btn-primary text-white">Compare!</button>
					</div>

					<div class="list2">
						@error('list2')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						<div class="input-group">
							<span class="input-group-text" id="filter2label">Filter</span>
							<input class="form-control" type="search" placeholder="Filter..." aria-labelledby="filter2label" onkeyup="filter('filter2', 'list2')" id="filter2">
						</div>
						<ul class="list-group bg-dark mt-2" id="list2">
							@foreach($loadOrders as $list)
							<label for="list2-{{ $list->id }}">
								<li class="bg-dark text-white list-group-item list-group-item-dark my-1 d-flex align-items-center">
									<input class="compare-radio" type="radio" name="list2" id="list2-{{ $list->id }}" value="{{ $list->slug }}">
									<span class=" compare-checkbox"></span>
									<div class="list-info">
										<h4><a href="/lists/{{ $list->slug }}">{{ $list->name }}</a></h4>
										<span>by <b>{{ $list->author ? $list->author->name : 'Anonymous' }}</b></span>
									</div>
								</li>
							</label>
							@endforeach
						</ul>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	function filter(search, list) {

		// Declare variables
		var input, filter, ul, li, a, i, txtValue;
		input = document.getElementById(search);
		filter = input.value.toLowerCase();
		ul = document.getElementById(list);
		li = ul.getElementsByTagName('label'); // We actually want to hid the label to prevent weird spacing on filter.

		// Loop through all list items, and hide those who don't match the search query

		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("div")[0];
			txtValue = a.textContent.trim() || a.innerText.trim();
			if (txtValue.toLowerCase().indexOf(filter) >= 0) {
				li[i].classList.remove('d-none');
				//li[i].classList.add('d-flex');
			} else {
				//li[i].classList.remove('d-flex');
				li[i].classList.add('d-none');
			}
		}
	}
</script>