<ur class="list-group">
	@if(count($links))
		@foreach($links as $link)
			<li class="list-group-item">
				<form method="POST" action="/votes/{{$link->id}}">
					{!! csrf_field() !!}

					<button class="btn {{ Auth::check() && Auth::user()->votedFor($link)  ? 'btn-success' : ''}} ">
						{{ $link->votes->count() }}
					</button>
				</form>


				<a href="/community/{{$link->channel->slug}}" class="label"
					style="background: {{$link->channel->color}}"
				>
					{{$link->channel->title}}
				</a>
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

{{ $links->links() }}
