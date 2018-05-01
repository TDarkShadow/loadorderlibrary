@extends('layouts.app')

@section('content')
	<div class="row row-center">
		<div class="col-md-4">
			<div class="card card-center">
				<form method="POST" class="form-center" enctype="multipart/form-data">
					@csrf
					<h2 class="text-center padding-bottom-10">Upload Load Order</h2>

					@if(Auth::check())
						<div class="text-inputs">
							<div class="group">      
								<input id="list-name" type="text" class="" name="list-name" value="{{ old('list-name') }}" autofocus>
								<span class="highlight"></span>
								<span class="bar"></span>
								<label>List Name (required)</label>
							</div>

							<div class="group">      
								<input id="description" type="text" class="" value="{{ old('description') }}" name="description" >
								<span class="highlight"></span>
								<span class="bar"></span>
								<label>Description (optional)</label>
							</div>
						</div>
					
						<div class="group">
							<input type="checkbox" name="private" {{ old('private') ? 'checked' : '' }}> 
							<label>Private List</label>
							<p class="tooltip">Private Lists will not be displayed on the main page</p>
						</div>
					@endif

					<p>modlist.txt and plugins.txt are required to be uploaded, feel free to upload any ini files as well.</p>
					<div class="group group-center">
						<select name="game" id="game">
							<option value="0" selected>-- Choose Game --</option>
							@foreach($games as $game)
								<option value="{{$game->id}}">{{$game->name}}</option>
							@endforeach

						</select>

					</div>

					<div class="group group-center">
						
						<input class="file-upload" type="file" id="files" name="files[]" accept=".txt,.ini" data-multiple-caption="{count} files selected" multiple required/>
						<label for="files" class="md-button"><span>Choose Files...</span></label>

						<button type="submit" class="md-button">
							{{ __('Upload') }}
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
		</div>
	</div>
@endsection