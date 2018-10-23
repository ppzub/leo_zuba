	<div class="container">
		<div class="row">
			<div class="col xl9 l9 m12 s12">
				<div class="my-card-panel green lighten-2 white-text z-depth-2">
					<h6>Новини</h6>
				</div>
				@foreach($news as $new)
				<div class="row">

					<div class="col xl4 l4 m4 s5">
						<a class="my-img-link" href="{{route('post.show', $new->id)}}">
				    		<img class="responsive-img my-img-link" src="{{$new->getImage()->medium}}">
				    	</a>
			  		</div>

					<div class="col xl8 l8 m8 s7">
						{{ mb_substr($new->content, 0, 80) }}...
						<div class="my-date">{{$new->getDate()}}</div>
					</div>
				</div>
				@endforeach
				<div class="my-paginator">{{ $news->links('layouts.paginate') }}</div>
			</div>
			<div class="col xl3 l3 m6 s12 my-sidebar">
			<div class="my-card-panel green lighten-2 white-text z-depth-2">
				<h6>shuffle відео</h6>
			</div>
			@foreach ($sidebar_video_data  as $video)
				<div class="thumb">
				    <span class="cat-title grey-text text-darken-2">{{$video['title']}}</span><br>
						<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$video['id']}}?autoplay=true">
							<img id="main-img" class="responsive-img" src="{{$video['thumb']}}">
							<img class="youtube-logo" src="{{asset('img')}}/yt_logo_mono_dark.png">
						</a>
				</div>
			@endforeach
			<a href="{{route('videos.show')}}" class="right deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">всі відео</a>
			</div>
		</div>
	</div>