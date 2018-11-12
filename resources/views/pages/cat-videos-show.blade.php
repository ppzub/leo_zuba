<div class="row">
	<div class="col xl12 l12 m12 s12">
		@if($cat_video_data_show)
		<div class="my-card-panel deep-purple lighten-2 white-text z-depth-2">
			<h6>{{ $cat->title }}: відео</h6>
		</div>
		<div class="hide-on-med-and-up">
			@for($i=0, $j=1; $i<count($cat_video_data_show); $i++)
				@if(($i == 0) || ($i%2 == 0))
					<div class="row">
				@endif
						<div class="col s6 thumb">
							<span class="cat-title grey-text text-darken-2 span-mobile">{{$cat_video_data_show[$i]['title']}}</span>
								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$cat_video_data_show[$i]['id']}}?autoplay=true">
									<img id="main-img" class="responsive-img" src="{{$cat_video_data_show[$i]['thumb']}}">
									<img class="youtube-logo youtube-logo-mobile" src="{{asset('img')}}/yt_logo_mono_dark.png">
								</a>
						</div>
				@if (($i == $j) || ($i == count($cat_video_data_show) - 1))
				@php($j+=2)
					</div>
				@endif
			@endfor
		</div>
		<div class="hide-on-small-only">
			@for($i=0, $j=2; $i<count($cat_video_data_show); $i++)
				@if(($i == 0) || ($i%3 == 0))
					<div class="row">
				@endif
						<div class="col xl4 l4 m4 thumb">
							<span class="cat-title grey-text text-darken-2">{{$cat_video_data_show[$i]['title']}}</span>
								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$cat_video_data_show[$i]['id']}}?autoplay=true">
									<img id="main-img" class="responsive-img" src="{{$cat_video_data_show[$i]['thumb']}}">
									<img class="youtube-logo youtube-logo-mobile" src="{{asset('img')}}/yt_logo_mono_dark.png">
								</a>
						</div>
				@if (($i == $j) || ($i == count($cat_video_data_show) - 1))
				@php($j+=3)
					</div>
				@endif
			@endfor
		</div>
		@endif
	</div>
</div>