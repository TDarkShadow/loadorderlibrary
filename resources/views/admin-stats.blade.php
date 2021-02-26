@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container">
	<h1 class="text-white">Simple Stats</h1>
	<div class="row">
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
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection