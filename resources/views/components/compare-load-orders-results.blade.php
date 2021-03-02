<div class="accordion" id="accordion">
	@foreach($results['contents'] as $file)
	<div class="card bg-dark col-md-12 mb-1 p-0">
		<div class="card-header d-flex justify-content-between align-items-center m-0 pl-0" id="heading{{$loop->index}}">
			<h5 class="mb-0">
				<button class="ml-1 btn btn-link collapsed inline" type="button" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
					<span class="text-white"><b>+</b></span> <b>{{ $file['filename'] }}</b>
				</button>
			</h5>

			<span class="badge badge-pill {{ $file['class'] }}">{{ $file['class'] == 'badge-danger' ? 'Differences' : 'No Differences' }}</span>
		</div>

		<div id="collapse{{$loop->index}}" class="collapse" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion">
			<div class="text-white card-body bg-dark m-0 pr-10">
				<div class="files-heading d-flex justify-content-between align-self-stretch mb-2">
					<div class="missing">
						<h3 class="text-white">Missing Lines</h3>
						<small class="text-white">Mods/settings not in <b>{{ $list1->name }}</b></small>
					</div>

					<div class="added">
						<h3 class="text-white">Added Lines</h3>
						<small class="text-white">Mods/settings not in <b>{{ $list2->name }}</b></small>
					</div>
				</div>
				<div class="files d-flex justify-content-between">
					<div class="p-0 col-md-6 missing">
						<ul class="list-group bg-dark lo-list d-flex" id="list{{$loop->index}}">
							@forelse($file['missing'] as $missing)
							<li class="bg-dark text-white list-group-item list-group-item-dark  d-flex align-items-center">
								<div class="line">
									{{$missing}}
								</div>
							</li>
							@empty
							<li class="bg-dark text-white list-group-item list-group-item-dark d-flex align-items-center">
								<div class="line">
									Nothing is missing.
								</div>
							</li>
							@endforelse
						</ul>
					</div>

					<div class="p-0 col-md-6 added">
						<ul class="list-group bg-dark lo-list" id="list{{$loop->index}}">
							@forelse($file['added'] as $added)
							<li class="bg-dark text-white list-group-item list-group-item-dark d-flex align-items-center">
								<div class="line">
									{{$added}}
								</div>
							</li>
							@empty
							<li class="bg-dark text-white list-group-item list-group-item-dark d-flex align-items-center">
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
	</div>
	@endforeach
</div>