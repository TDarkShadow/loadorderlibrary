@extends('layouts.app')

@section('title', 'Admin Stats')

@section('content')
<div class="container">
	<h1 class="text-white">Simple Stats</h1>
	<div class="row mb-5">
		<div class="d-flex col-md-4 align-items-stretch">
			<div class="flex-fill card text-white bg-dark">
				<div class="card-header">
					<h3 class="card-title p-0 m-0">{{ __('List Stats') }}</h3>
				</div>

				<div class="card-body p-0">
					<ul class="list-group bg-dark">
						@foreach($listStats as $stat)
						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $stat['name'] }}
							<span class="badge bg-secondary rounded-pill">{{ $stat['value'] }}</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

		<div class="d-flex col-md-4 align-items-stretch">
			<div class="flex-fill card text-white bg-dark">
				<div class="card-header">
					<h3 class="card-title p-0 m-0">{{ __('User Stats') }}</h3>
				</div>

				<div class="card-body p-0">
					<ul class="list-group bg-dark">
						@foreach($userStats as $stat)
						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $stat['name'] }}
							<span class="badge bg-secondary rounded-pill">{{ $stat['value'] }}</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

		<div class="d-flex col-md-4 align-items-stretch">
			<div class="flex-fill card text-white bg-dark">
				<div class="card-header">
					<h3 class="card-title p-0 m-0">{{ __('File Stats') }}</h3>
				</div>

				<div class="card-body p-0">
					<ul class="list-group bg-dark">
						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $fileStats[0]['name'] }}
							<span class="badge bg-secondary rounded-pill">{{ $fileStats[0]['value'] }}</span>
						</li>

						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $fileStats[1]['name'] }}
							<span class="badge {{ ($fileStats[1]['value'] > 10) ? 'bg-danger' : 'bg-secondary' }} rounded-pill">{{ $fileStats[1]['value'] }} MB</span>
						</li>

						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $fileStats[2]['name'] }}
							<span class="badge {{ ($fileStats[1]['value'] > 10) ? 'bg-danger' : 'bg-secondary' }} rounded-pill">{{ $fileStats[2]['value'] }} MB</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="accordion-item bg-dark mb-1">
				<div class="accordion-header d-flex justify-content-between align-items-center pe-3">
					<h2 class="m-0 p-0" id="heading-in-lists">
						<button class="accordion-button collapsed bg-dark text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-in-lists" aria-expanded="false" aria-controls="collapse-in-lists">
							<span class="text-white"><b>&plus;</b></span> <b> Files In Lists</b>
						</button>

					</h2>
				</div>
				<div id="collapse-in-lists" class="accordion-collapse collapse" aria-labelledby="heading-in-lists" data-bs-parent="#accordion">
					<div class="accordion-body text-white p-0">
						<table class="table table-striped table-dark text-white">
							<thead>
								<tr>
									<th scope="col">File</th>
									<th scope="col">Size (Bytes)</th>
									<th scope="col">Lists</th>
								</tr>
							</thead>
							<tbody>
								@foreach($filesInLists as $file)
								<tr>
									<td>{{ $file->name }}</td>
									<td>{{ $file->size_in_bytes }}</td>
									<td><span class="badge bg-secondary rounded-pill">{{ count($file->lists) }}</span></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="accordion-item bg-dark mb-1">
				<div class="accordion-header d-flex justify-content-between align-items-center pe-3">
					<h2 class="m-0 p-0" id="heading-orphaned">
						<button class="accordion-button collapsed bg-dark text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-orphaned" aria-expanded="false" aria-controls="collapse-orphaned">
							<span class="text-white"><b>&plus;</b></span> <b>Orphaned Files</b>
						</button>
					</h2>
					<span class="badge rounded-pill bg-danger">{{ count($orphanedFiles) }}</span>
				</div>
				<div id="collapse-orphaned" class="accordion-collapse collapse" aria-labelledby="heading-orphaned" data-bs-parent="#accordion">
					<div class="accordion-body text-white p-0">
						<ul class="list-group bg-dark" id="list-orphaned">
							@foreach($orphanedFiles as $file)
							<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
								{{ $file['name'] }}
								<span class="badge bg-danger">TODO: Delete</span>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection