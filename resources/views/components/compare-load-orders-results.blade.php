<div class="accordion" id="accordion">
	@foreach($results['contents'] as $file)
	<div class="card bg-dark col-md-12 mb-1 p-0">
		<div class="card-header d-flex justify-content-between align-items-center m-0 pl-0" id="heading{{$loop->index}}">
			<h5 class="mb-0">
				<button class="btn btn-link collapsed inline" type="button" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
					{{ $file['filename'] }}
				</button>
			</h5>
			<!-- <form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Filter..." aria-label="Filter" onkeyup="filter('filter{{$loop->index}}', 'list{{$loop->index}}')" id="filter{{$loop->index}}">
			</form> -->
		</div>

		<div id="collapse{{$loop->index}}" class="collapse" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion">
			<div class="card-body bg-dark d-flex m-0 pr-10">
				<div class="col-md-6 missing">
					<h3 class="text-white">Missing <small class="text-white">(mods/settings not in {{ $list1->name }})</small></h3>
					<ul class="list-group bg-dark lo-list" id="list{{$loop->index}}">
						@forelse($file['missing'] as $missing)
						<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
							<div class="line">
								{{$missing}}
							</div>
						</li>
						@empty
						<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
							<div class="line">
								Nothing is missing.
							</div>
						</li>
						@endforelse
					</ul>
				</div>

				<div class="col-md-6 added">
					<h3 class="text-white">Added <small class="text-white">(mods/settings not in {{ $list2->name }})</small></h3>

					<ul class="list-group bg-dark lo-list" id="list{{$loop->index}}">
						@forelse($file['added'] as $added)
						<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
							<div class="line">
								{{$added}}
							</div>
						</li>
						@empty
						<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
							<div class="line">
								Nothing is added.
							</div>
						</li>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>

<!-- <script>
	function filter(search, list) {

		// Declare variables
		var input, filter, ul, li, a, i, txtValue;
		input = document.getElementById(search);
		filter = input.value.toLowerCase();
		ul = document.getElementById(list);
		li = ul.getElementsByTagName('li');

		// Loop through all list items, and hide those who don't match the search query
		for (i = 0; i < li.length; i++) {

			a = li[i].getElementsByTagName("div")[0];
			txtValue = a.textContent.trim() || a.innerText.trim();
			if (txtValue.toLowerCase().indexOf(filter) >= 0) {
				li[i].style.display = "";
				li[i].classList = 'bg-dark text-white list-group-item lo-list-item d-flex align-items-center';
			} else {
				li[i].style.display = 'none';
				li[i].classList -= 'd-flex';
			}
		}
	}
</script> -->