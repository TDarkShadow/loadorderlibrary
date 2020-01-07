@extends('layouts.app')


@section('content')
<a id="top"></a>
<div class="row row-center">
	<div class="col-md-8">
		<div class="box-row card">
			<h2>{{$loadOrder->name}}</h2>
			<div class="loadorder-info">
				<div class="info">
					<a href="/loadorders/{{$loadOrder->slug}}">
						<div class="head">
							<p class="title"><small><em>{{$loadOrder->game->name}}</em></small></p>
							<p class="last-updated"><small><em>Updated: {{$loadOrder->updated_at}}</em></small></p>
							@if($guest != 0)
							<p class="author">By <a href="/{{$loadOrder->user->username}}">{{$loadOrder->user->username}}</a></p>
							@endif
						</div>
					</a>

					<div class="description">
						<p class="">{{$loadOrder->description}}</p>
					</div>
				</div>
			</div>

			@if(auth()->user()->admin)
			<div class="actions">
				<form method="POST" action="/lo/{{$loadOrder->slug}}/delete">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<button class="md-button-small button-red">Delete</button>
				</form>
			</div>
			@endif
		</div>
	</div>
</div>


<div class="row row-center">
	@foreach($keys as $tab)
	<div class="col-md-5">
		<a class="anchor-tab" id="{{$tab}}"></a>
		<div class="box-row card">
			<h2 class="capitalize">{{$tab}}</h2>
			<table>
				@for($i = 0; $i < count($list[$tab]); $i++) <tr>
					<td>{{ $i + 1 }}</td>
					<td>{{ $list[$tab][$i] }}</td>
					</tr>
					@endfor
			</table>
		</div>
	</div>
	@endforeach
</div>


<div class="quick-nav">
	<ul>
		<a href="#top">
			<li>Top</li>
		</a>
		@foreach($keys as $tab)
		<a href="#{{$tab}}">
			<li>{{$tab}}</li>
		</a>
		@endforeach
	</ul>
</div>
@endsection