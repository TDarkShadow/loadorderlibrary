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
							<span class="badge badge-secondary badge-pill">{{ $stat['value'] }}</span>
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
							<span class="badge badge-secondary badge-pill">{{ $stat['value'] }}</span>
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
							<span class="badge badge-secondary badge-pill">{{ $fileStats[0]['value'] }}</span>
						</li>

						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $fileStats[1]['name'] }}
							<span class="badge {{ ($fileStats[1]['value'] > 10) ? 'badge-danger' : 'badge-secondary' }} badge-pill">{{ $fileStats[1]['value'] }} MB</span>
						</li>

						<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
							{{ $fileStats[2]['name'] }}
							<span class="badge {{ ($fileStats[1]['value'] > 10) ? 'badge-danger' : 'badge-secondary' }} badge-pill">{{ $fileStats[2]['value'] }} MB</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="accordion" id="accordion">
				<div class="card bg-dark col-md-12 mb-1 p-0">
					<div class="card-header d-flex justify-content-between align-items-center m-0 pl-0" id="heading-in-lists">
						<h5 class="mb-0">
							<button class="ml-1 btn btn-link collapsed inline" type="button" data-toggle="collapse" data-target="#collapse-in-lists" aria-expanded="false" aria-controls="collapse-in-lists">
								<span class="text-white"><b>&plus;</b></span> <b>Files In Lists</b>
							</button>
						</h5>
					</div>

					<div id="collapse-in-lists" class="collapse" aria-labelledby="heading-in-lists" data-parent="#accordion">
						<div class="card-body bg-dark m-0 p-0">
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
										<td><span class="badge badge-secondary badge-pill">{{ count($file->lists) }}</span></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="accordion" id="accordion">
				<div class="card bg-dark col-md-12 mb-1 p-0">
					<div class="card-header d-flex justify-content-between align-items-center m-0 pl-0" id="heading-orphaned">
						<h5 class="mb-0">
							<button class="ml-1 btn btn-link collapsed inline" type="button" data-toggle="collapse" data-target="#collapse-orphaned" aria-expanded="false" aria-controls="collapse-orphaned">
								<span class="text-white"><b>&plus;</b></span> <b>Orphaned Files</b>
							</button>
						</h5>
					</div>

					<div id="collapse-orphaned" class="collapse" aria-labelledby="heading-orphaned" data-parent="#accordion">
						<div class="card-body bg-dark m-0 p-0">
							<ul class="list-group bg-dark" id="list-orphaned">
								@foreach($orphanedFiles as $file)
								<li class="list-group-item list-group-item-dark d-flex justify-content-between align-items-center">
									{{ $file['name'] }}
									<span class="badge badge-danger">TODO: Delete</span>
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