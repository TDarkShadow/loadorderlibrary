<div>
	<!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
	<form>
		<div class="form-group">
			<label for="list-name">List Name</label>
			<input type="text" class="form-control" id="list-name" aria-describedby="emailHelp" value="{{ $loadOrder->name }}">
			<small id="list-help" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1">
		</div>
		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="exampleCheck1">
			<label class="form-check-label" for="exampleCheck1">Check me out</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>