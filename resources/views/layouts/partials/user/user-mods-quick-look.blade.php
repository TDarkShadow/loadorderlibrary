<div class="box card">
	<h2>Your Mods</h2>
	@foreach($loadOrders as $loadOrder)
	<div class="loadorder-info">
		<div class="info">
			<a href="/lo/{{$loadOrder->slug}}">
				<div class="head">
					<p class="title">{{$loadOrder->name}} - <small><em>{{$loadOrder->game->name}}</em></small></p><br />
					<p class="last-updated"><small><em>Updated {{$loadOrder->updated_at}}</em></small></p>
				</div>
			</a>

			<div class="description">
				<p class="">{{$loadOrder->description}}</p>
			</div>
		</div>

		<div class="actions">
			<a href="/lo/{{$loadOrder->slug}}/edit"><button class="md-button-small button-blue">Edit</button></a>
			<form method="POST" action="/lo/{{$loadOrder->slug}}/delete">
				{{ csrf_field() }}
				{{ method_field('delete') }}
				<button class="md-button-small button-red">Delete</button>
			</form>
		</div>
	</div>
	@endforeach
</div>