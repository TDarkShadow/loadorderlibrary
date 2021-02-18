@extends('layouts.app')

@section('title', 'Compare Results')

@section('content')
<h1 class="text-white">Compare Results (BETA)</h1>
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card bg-dark col-md-12 mb-3">
			<div class="card-header d-flex justify-content-between align-items-center text-white compare-results">
				<div class="list1">
					<h3><a href="/lists/{{ $list1->slug }}">{{ $list1->name }}</a></h3>
					<span>by <b>{{ $list1->author ? $list1->author->name : 'Anonymous' }}</b></span>
				</div>
				<div class="align-self-center vs">
					<h5>VS.</h5>
				</div>
				<div class="list2">
					<h3><a href="/lists/{{ $list2->slug }}">{{ $list2->name }}</a></h3>
					<span>by <b>{{ $list2->author ? $list2->author->name : 'Anonymous' }}</b></span>
				</div>

			</div>

			<div class="text-white card-body bg-dark m-0 pr-10">
				<div class="files-heading d-flex justify-content-between align-self-stretch mb-2">
					<div class="missing">
						<h3 class="text-white">Missing Files</h3>
						<small class="text-white">Files not in <b>{{ $list1->name }}</b></small>
					</div>

					<div class="added">
						<h3 class="text-white">Added Files</h3>
						<small class="text-white">Files not in <b>{{ $list2->name }}</b></small>
					</div>
				</div>
				<div class="files d-flex justify-content-between">
					<div class="p-0 col-md-6 missing">
						<ul class="list-group bg-dark lo-list d-flex">
							@forelse($results['files'][0]['missing'] as $missing)
							<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
								<div class="line">
									{{$missing}}
								</div>
							</li>
							@empty
							<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
								<div class="line">
									Nothing is missing.
								</div>
							</li>
							@endforelse
						</ul>
					</div>

					<div class="p-0 col-md-6 added">
						<ul class="list-group bg-dark lo-list">
							@forelse($results['files'][0]['added'] as $added)
							<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
								<div class="line">
									{{$added}}
								</div>
							</li>
							@empty
							<li class="bg-dark text-white list-group-item lo-list-item d-flex align-items-center">
								<div class="line">
									Nothing is added.
								</div>
							</li>
							@endforelse
						</ul>
					</div>
				</div>


			</div>

			<div class="card-footer text-white">
				NOTE: Results below only show differences between files that exist in both lists. If no files are shown below, they are the exact same in both lists.
			</div>

		</div>

		<x-compare-load-orders-results :results=$results :list1=$list1 :list2=$list2 />
	</div>
</div>
@endsection