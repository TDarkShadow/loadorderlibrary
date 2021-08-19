@extends('layouts.app')

@section('title', 'Admin Backups')

@section('content')

<table class="table table-dark table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">File</th>
			<th scope="col">Size in MB</th>
			<th scope="col">Created</th>
			<th scope="col">Deletes In</th>
			<th scope="col">Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($backups as $backup)
		<tr>
			<td><strong>{{ $backup->file }}</strong></td>
			<td>{{ $backup->size }}</td>
			<td>{{ $backup->created_at->diffForHumans() }}</td>
			<td>{{ $backup->expires_at->diffForHumans(
					['parts' => '1 | Carbon::ROUND | Carbon::SEQUENTIAL_PARTS_ONLY']		
			 ) }}</td>
			<td class="d-flex">
				<a class="ml-2 btn btn-secondary btn-sm text-white" href="/admin/backups/download/{{$backup->id}}" role="button">Download</a>
				<form class="form-inline mx-2" method="POST" action="/admin/backups/delete/{{$backup->id}}">
					@method('delete')
					@csrf
					<button class="ml-2 btn btn-danger btn-sm" href="#" role="button">Delete</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection