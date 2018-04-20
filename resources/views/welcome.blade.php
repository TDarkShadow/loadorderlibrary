@extends('layouts.app')

@section('content')
	<div class="row row-center">
		<div class="col col-6 card">
			<h2>What is this?</h2>	
			<p class="indent">Load Order Library is a website/tool to share mod lists of Bethesda games (currently only Skyrim) with other users. Primarily for debugging purposes, but can be quite useful for YouTuber's to have mod lists for each of their LP characters, mod list creators to share with users, etc.</p>

			<h2>How do I use this?</h2>	
			<p class="indent">At the moment, we only support Mod Organizer lists, but will expand to support other tool in the near future. To upload a mod list, simply click "upload" and select the requested Mod Organizer files. Once uploaded, a handy link will be provided to share with others! If you would like more features such as editing mod lists, deleting them, among other things, feel free to make an account before uploading.</p>


			<div class="grid-center">
				<button class="md-button">Upload List</button>
			</div>
		</div>
	</div>
@endsection