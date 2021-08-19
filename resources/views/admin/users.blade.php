@extends('layouts.app')

@section('title', 'Admin Stats')

@section('content')

<table class="table table-dark table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Lists</th>
			<th scope="col">Verified Author</th>
			<th scope="col">Created</th>
			<th scope="col">Toggle Verified</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td><strong>{{ $user->name }}</strong></td>
			<td>{{ $user->email ? 'Yes' : 'No' }}</td>
			<td>{{ $user->lists_count }}</td>
			<td class="{{ $user->is_verified ? 'text-primary' : 'text-danger' }}">{{ $user->is_verified ? 'Yes' : 'No' }}</td>
			<td>{{ \Carbon\Carbon::createFromTimestamp($user->created_at)->format('Y-m-d H:i:s T') }}</td>
			<td>
				<form method="POST" action="/admin/users/verify/{{ $user->id }}">
					@csrf
					<button type="submit" class="btn btn-secondary btn-sm text-white">Toggle</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection