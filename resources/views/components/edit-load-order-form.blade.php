<form method="POST" action="{{ route('lists.update', $loadOrder->slug) }}" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="form-group">
		<label for="name">List Name</label>
		<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') ?? $loadOrder->name }}">
		@error('name')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group">
		<label for="description">Description</label>
		<textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description') ?? $loadOrder->description }}</textarea>
		@error('description')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group">
		<label for="game">Game</label>
		<select name="game" class="form-control @error('game') is-invalid @enderror" id="game">
			<option value="">-Choose Game-</option>
			@foreach($games as $game)
			<option {{ $game->id == $loadOrder->game->id ? 'selected' : '' }} value={{ $game->id }} @if(old('game')==$game->id) selected @endif> {{ $game->name }}</option>
			@endforeach
		</select>
		@error('game')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-check form-check-inline">
		<input name="private" class="form-check-input @error('private') is-invalid @enderror" type="checkbox" value="private" id="private" aria-describedby="privateHelp" {{ $loadOrder->is_private ? 'checked' : ''}}>
		<label class="form-check-label" for="private">
			Private?
		</label>
		@error('private')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>
	<small id="privateHelp" class="form-text text-muted">
		Private lists will not appear on the Browse Lists page, but can be viewed directly with the link, or from Your Lists if uploading with an account.
	</small>

	<div class="form-group">
		<label for="files">Add/Edit Files</label>
		<input name="files[]" type="file" class="form-control-file @error('files.*') is-invalid @enderror" id="files" accept=".txt,.ini" multiple>
		<span class="text-muted">It's recommended to copy the files you want to upload to a single folder, then choose them all from that folder. Files uploaded of the same name as one that's already in the list will replace it. If you are not adding/updating files, don't select any.</span>
		@error('files.*')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group">
		<label>Files In List</label>
		<span class="text-muted">Uncheck a file to remove it from the list</span>
		@foreach($loadOrder->files as $file)
		<div class="form-check">
			<input name="existing-files[]" class="form-check-input" type="checkbox" value="{{ $file->clean_name . '-' . $file->id }}" id="check-{{ $file->clean_name }}" checked>
			<label class="form-check-label" for="check-{{ $file->clean_name }}">
				{{ $file->clean_name }}
			</label>
		</div>
		@endforeach
	</div>
	<button class="btn btn-primary" type="submit">Update List</button>
</form>