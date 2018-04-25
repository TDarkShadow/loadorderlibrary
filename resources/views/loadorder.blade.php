@extends('layouts.app')


@section('content')
	<a id="top"></a>
	@if($guest != 0)
		<div class="row row-center">
			<div class="col-md-6">
				<div class="box-row card">
					<h1>{{$listInfo[3]}}</h1>
					<p>Uploaded By: {{$listInfo[0]}}</p>
					<p>Uploaded At: {{$listInfo[1]}}</p>
					<p>Updated At: {{$listInfo[2]}}</p>
					<p>{{$listInfo[4]}}</p>
				</div>
			</div>
		</div>
	@endif
		
	<div class="row row-center">
		@foreach($keys as $tab)
			<div class="col-md-6">
				<a class="anchor-tab" id="{{$tab}}"></a>
				<div class="box-row card">
					<h2 class="capitalize">{{$tab}}</h2>
					<table>
						@for($i = 0; $i < count($loadOrder[$tab]); $i++)
							<tr>
								<td>{{ $i + 1 }}</td>
								<td>{{ $loadOrder[$tab][$i] }}</td>
							</tr>
						@endfor
					</table>	
				</div>
			</div>
		@endforeach	
	</div>


	<div class="quick-nav">
		<ul>
			<a href="#top"><li>Top</li></a>
			@foreach($keys as $tab)
				<a href="#{{$tab}}"><li>{{$tab}}</li></a>
			@endforeach
		</ul>
	</div>
@endsection