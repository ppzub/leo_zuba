<div class="row">
	<div class="col xl12 l12 m12 s12">
		@if($cat_video_data_show)
		<div class="my-card-panel green lighten-2 white-text z-depth-2">
			<h6>{{ $cat->title }}: відео</h6>
		</div>
			@for($i=0, $j=1; $i<count($cat_video_data_show); $i++)
				@if(($i == 0) || ($i%2 == 0))
					<div class="row">
				@endif
						<div class="col xl6 l6 m6 s6 thumb">
							<span class="cat-title grey-text text-darken-2">{{$cat_video_data_show[$i]['title']}}</span>
								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$cat_video_data_show[$i]['id']}}?autoplay=true">
									<img id="main-img" class="responsive-img" src="{{$cat_video_data_show[$i]['thumb']}}">
									<img class="youtube-logo" src="{{asset('img')}}/yt_logo_mono_dark.png">
								</a>
						</div>
				@if (($i == $j) || ($i == count($cat_video_data_show) - 1))
				@php($j+=2)
					</div>
				@endif
			@endfor
		@endif
	</div>
</div>