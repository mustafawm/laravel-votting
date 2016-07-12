@if (Auth::check())
<div class="panel panel-default">
	<div class="panel-heading">Contribute a link</div>
	<div class="panel-body">

		<form action="/community" method="post">
			{!! csrf_field() !!}

			<div class="form-group {{$errors->has('channel_id') ? 'has-error' : '' }}">
				{!! $errors->first('channel_id','<span class="help-block"> :message </span>') !!}

				<select class="form-control" name="channel_id">
					<option selected disabled>Pick a channel</option>
					@foreach($channels as $channel)
						<option
							value="{{$channel->id}}"
							{{old('channel_id') == $channel->id ? 'selected' : ''}}
						>
							{{$channel->title}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group {{$errors->has('title') ? 'has-error' : '' }}">
				{!! $errors->first('title','<span class="help-block"> :message </span>') !!}

				<input
					type="text" class="form-control" name="title"
					placeholder="Title of your article"
					value="{{ old('title') }}"
				/>
			</div>

			<div class="form-group {{$errors->has('link') ? 'has-error' : '' }}">
				{!! $errors->first('link','<span class="help-block"> :message </span>') !!}

				<input
					type="url" class="form-control" name="link"
					placeholder="URL to your article"
					value="{{ old('link') }}"
				/>
			</div>

			<div class="form-group">
				<button class="btn btn-primary">Contribute Link</button>
			</div>
		</form>

	</div>
</div>
@else
Sign in to contribute a link
@endif
