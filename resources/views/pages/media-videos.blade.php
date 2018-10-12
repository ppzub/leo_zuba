	<div class="row">
		<div class="col xl12 l12 m12 s12">

			@foreach ($media as $k => $cat)
				@if (!$cat->posts->isEmpty())
					<div class="my-card-panel green lighten-2 white-text z-depth-2">
						<h6>{{ $cat->title }}: відео</h6>
					</div>
					@php($j = 1)
					@php($i = 0)
					@foreach ($video_data[$k] as $video)
						@if(($i == 0) || ($i%2 == 0))
							<div class="row">
						@endif
						<div class="col xl6 l6 m6 s6 thumb">
							<span class="cat-title grey-text text-darken-2">{{$video['title']}}</span>
								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$video['id']}}?autoplay=true">
									<img id="main-img" class="responsive-img" src="{{$video['thumb']}}">
									<img class="youtube-logo" src="{{asset('img')}}/yt_logo_mono_dark.png">
								</a>
						</div>

						@if (($i == $j) || ($i == count($video_data[$k]) - 1))
							@php($j+=2)
								</div>
						@endif
					@php($i++)
					@endforeach
				@endif
			@endforeach
		</div>
	</div>
	<div></div>
