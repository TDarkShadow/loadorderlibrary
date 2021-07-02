<div class="accordion" id="accordion">
	@foreach($results['contents'] as $file)
	<div class="accordion-item bg-dark mb-1">
		<div class="accordion-header d-flex justify-content-between align-items-center pe-3">
			<h2 class="m-0 p-0" id="heading{{$loop->index}}">
				<button class="accordion-button collapsed bg-dark text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
					<span class="text-white"><b>&plus;</b></span> <b>{{ $file['filename'] }}</b>
				</button>
			</h2>

			<span class="badge badge-pill {{ $file['class'] }}">{{ $file['class'] == 'bg-danger' ? 'Differences' : 'No Differences' }}</span>
		</div>
	
		<div id="collapse{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->index}}" data-bs-parent="#accordion">
			<div class="accordion-body text-white p-3">
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