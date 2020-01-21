<div class="box card">
	<h2>Compare List</h2>
	<p>Compare against this list</p>

	<form method="POST" class="form-center" enctype="multipart/form-data" action="/compare">
		@csrf
		<div class="group group-center">
			<select name="target" id="target" hidden>
				<option value="{{$loadOrder->id}}">{{$loadOrder->name}}</option>
			</select>

		</div>
		<div class="group group-center">

			<input class="file-upload" type="file" id="files" name="files[]" accept=".txt,.ini" data-multiple-caption="{count} files selected" multiple required />
			<label for="files" class="md-button"><span>Choose Files...</span></label>

			<button type="submit" class="md-button">
				{{ __('Compare') }}
			</button>

			@if ($errors->has('files.*'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('files') }}</strong>
			</span>
			@endif
		</div>
		@foreach ($errors->all() as $error)
		<span class="invalid-feedback">{{ $error }}</span>
		@endforeach
	</form>
</div>