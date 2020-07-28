<div class="row d-flex align-items-stretch">
	<div class="col-md-12">
		@forelse($results as $result)
		<div class="card text-white bg-dark">
			<div class="card-header">
				<h1>{{ $result['filename'] }}</h1>
			</div>

			<div class="card-body d-flex">
				<div class="col-md-6">
					<h3>Missing</h3>
					<ul>
						@foreach($result['missing'] as $missing)
						<li>{{ $missing }}</li>
						@endforeach
					</ul>
				</div>

				<div class="col-md-6">
					<h3>Added</h3>
					<ul>
						@foreach($result['added'] as $added)
						<li>{{ $added }}</li>
						@endforeach
					</ul>
				</div>

			</div>
		</div>
		@empty
		<div class="card text-white bg-dark">
			<div class="card-body">
				No differences detected between lists!
			</div>
		</div>
		@endforelse
	</div>
</div>