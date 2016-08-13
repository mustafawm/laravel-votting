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

			<ul class="nav nav-tabs">
				<li class="{{ request()->exists('popular') ? '' : 'active' }}">
					<a href=" {{ request()->url() }} ">Recent</a>
				</li>

				<li class="{{ request()->exists('popular') ? 'active' : '' }}">
					<a href="?popular">Popular</a>
				</li>
			</ul>


			@include('community.list')

		</div>

		<div class="col-md-4">

			@include('community.add-link')

		</div>

	</div>
@endsection
