<form method="POST" enctype="multipart/form-data">
	@csrf
	<div class="form-group mb-3">
		<label for="name">List Name</label>
		<input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
		@error('name')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group mb-3">
		<label for="description">Description</label>
		<textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description') }}</textarea>
		@error('description')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group mb-3">
		<label for="version">Version</label>
		<small id="versionHelp" class="text-muted">Format is #.#.# with optional -alpha or -beta suffix, and # is any number.</small>
		<input name="version" type="text" class="form-control @error('version') is-invalid @enderror" id="version" value="{{ old('version') }}">
		@error('version')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group mb-3">
		<label for="game">Game</label>
		<select name="game" class="form-control @error('game') is-invalid @enderror" id="game">
			<option value="">-Choose Game-</option>
			@foreach($games as $game)
			<option value={{ $game->id }} @if(old('game')==$game->id) selected @endif> {{ $game->name }}</option>
			@endforeach
		</select>
		@error('game')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="form-group mb-3">
		<label for="files">Choose Files</label>
		<input name="files[]" type="file" class="form-control @error('files.*') is-invalid @enderror" id="files" accept=".txt,.ini" multiple required>
		<span class="text-muted">It's recommended to copy the files you want to upload to a single folder, then choose them all from that folder.</span>
		@error('files.*')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror
	</div>

	<div class="input-group d-flex align-items-center">
		<button class="btn btn-primary text-white me-3" type="submit">Upload</button>
		<div class="form-check form-switch">
			<input name="private" class="form-check-input @error('private') is-invalid @enderror" type="checkbox" value="private" id="private" aria-describedby="privateHelp">
			<label class="form-check-label" for="private">
				Private
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
	</div>
</form>