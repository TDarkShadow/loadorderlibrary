<div class="nav-menu">
	<ul>
		<li><a href="/upload"><button class="md-button">Upload</button></a></li>
		<li><a href="/lo">Browse Lists</a></li>
		<li><a href="/u/{{Auth::user()->username}}/settings">Account Settings</a></li>
		<li>
			<form action="{{ route('logout') }}" method="POST">
				@csrf
				<button class="text-button" type="submit">Logout</button>
			</form>
		</li>
	</ul>
</div>