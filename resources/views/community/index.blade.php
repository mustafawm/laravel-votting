@extends('layouts.app')

@section('content')
	<div class="row">

		<div class="col-md-8">
			<ur class="links">
				@if(count($links))
					@foreach($links as $link)
						<li class="links__link">
							<span class="label" style="background: {{$link->channel->color}}">
								{{$link->channel->title}}
							</span>

							<a href="{{$link->link}}" target="_blank"> {{$link->title}}</a>

							<small>
								Contributed by: <a href="#"> {{$link->creator->name}} </a>
								{{ $link->updated_at->diffForHumans() }}
							</small>
						</li>
					@endforeach
				@else
					<li> No contributions yet!</li>
				@endif
			</ur>
		</div>

		<div class="col-md-4">

			@include('community.add-link')

		</div>

	</div>
@endsection
