<div class="row d-flex align-items-stretch">
	<div class="col-md-12">
		<div class="card text-white bg-dark">
			<div class="card-header">
					Compare list 1 with list 2 to see if list 1 is missing anything, or has any extra entries.
				
			</div>
			<div class="card-body d-flex">
				<form class="d-flex col-md-12" method="POST">
					@csrf
					<div class="col-md-4">
						<div class="form-group">
							<label for="list1">List 1</label>
							<select name="list1" class="form-control @error('list1') is-invalid @enderror" id="list1">
								<option value="">-Choose List-</option>
								@foreach($loadOrders as $loadOrder)
								<option value={{ $loadOrder->slug }} @if(old('list1')==$loadOrder->slug) selected @endif> {{ $loadOrder->name }}</option>
								@endforeach
							</select>
							@error('list1')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="col-md-4 d-flex flex-row justify-content-center align-items-center">
						<button type="submit" class="btn btn-primary">Compare!</button>
					</div>
					<div class="col-md-4">

						<div class="form-group">
							<label for="list2">List 2</label>
							<select name="list2" class="form-control @error('list2') is-invalid @enderror" id="list2">
								<option value="">-Choose List-</option>
								@foreach($loadOrders as $loadOrder)
								<option value={{ $loadOrder->slug }} @if(old('list2')==$loadOrder->slug) selected @endif> {{ $loadOrder->name }}</option>
								@endforeach
							</select>
							@error('list2')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>