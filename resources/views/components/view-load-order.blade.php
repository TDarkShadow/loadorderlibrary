<div class="row d-flex align-items-stretch">
	<div class="col-md-12">
		<div class="card text-white bg-dark mb-3">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h3><strong><a href="/lists/{{ $loadOrder->slug }}" class="text-capitalize">{{ $loadOrder->name }}</a></strong></h3>
				<small><em><a href="/games/{{ $loadOrder->game->name }}">{{ $loadOrder->game->name }}</a></em></small>
			</div>
			<div class="card-body">
				{{ $loadOrder->description ?? 'No description provided.'}}
			</div>

			<div class="card-footer text-muted d-flex justify-content-between align-items-center">
				<small>Uploaded {{ $loadOrder->created_at->diffForHumans() }} by <a href="#">{{ $loadOrder->user->name ?? 'Anonymous' }}</a></small>
				@if($loadOrder->user == auth()->user() || auth()->user()->is_admin)
				<span>
					<form method="POST" action="/lists/{{$loadOrder->slug}}">
						@method('delete')
						@csrf
						<button class="btn text-danger" href="#" role="button">Delete</button>
					</form>
				</span>
				@endif
			</div>
		</div>


	</div>
</div>
<div class="row">
	@foreach($files as $file)
	<div class="col-md-6">
		<div class="card text-white bg-dark mb-3">
			<div class="card-header">
				<h3>{{ $file['name'] }}</h3>
			</div>

			<table class="table table-striped table-dark">
				@foreach(explode("\n", $file['content']) as $row)
				<tr>
					<td>{{ $row }}</td>
				</tr>
				@endforeach
			</table>

		</div>
	</div>
	@endforeach

</div>