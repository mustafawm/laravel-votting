@extends('layouts.app')

@section('content')
	<div class="row">

		<div class="col-md-8">
			<h3>
				<a href="/community"> Community Links</a>

				@if($channel->exists)
				<span>&mdash; {{$channel->title}}</span>
				@endif
			</h3>
			@include('community.list')

		</div>

		<div class="col-md-4">

			@include('community.add-link')

		</div>

	</div>
@endsection
