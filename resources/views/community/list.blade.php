<ur class="list-group">
	@if(count($links))
		@foreach($links as $link)
			<li class="list-group-item">
				@if(Auth::check() && Auth::user()->votedFor($link) )
					+1
				@endif

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
