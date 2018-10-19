<div class="row">
	<h1 class="hide">{{ $cat->title }}</h1>
	<div class="col xl12 l12 m12 s12">
		<div class="my-card-panel green lighten-2 white-text z-depth-2">
			<h6>{{ $cat->title }}</h6>
		</div>
		<div class="row">
				<div class="col xl4 l4 m4 s4">
					<a href="{{$cat->getImage()->large}}" class="imageSingle">
			    		<img id="main-img" class="responsive-img" src="{{$cat->getImage()->medium}}">
					</a>
		  		</div>
				<div class="col xl8 l8 m8 s8">
					{{$cat->content}}
				</div>
		</div>
		@if(!$cat_news->isEmpty())
		<h6 class="cat-title light-blue-text text-darken-1">Останні події</h6>
		<div class="row">
			@if(count($cat_news) == 1)
				@foreach($cat_news as $post)
					<div class="col xl4 l4 m4 s4">
					<a class="my-img-link" href="{{route('post.show', $post->id)}}">
				    	<img class="responsive-img my-img-link" src="{{$post->getImage()->medium}}">
				    </a>
					</div>
					<div class="col xl8 l8 m8 s8">
						{{$post->content}}
					</div>
				@endforeach
			@elseif(count($cat_news) == 2)
				@foreach($cat_news as $post)
					<div class="col xl4 l4 m4 s6">
						<a class="my-img-link" href="{{route('post.show', $post->id)}}">
				    		<img class="responsive-img my-img-link" src="{{$post->getImage()->medium}}">
				    	</a>
						{{$post->content}}
					</div>
				@endforeach
			@else
				@php($i = 0)
				@foreach($cat_news as $post)
					@if($i == 3)
						@break
					@endif
					<div class="col xl4 l4 m4 s4">
						<a class="my-img-link" href="{{route('post.show', $post->id)}}">
				    		<img class="responsive-img my-img-link" src="{{$post->getImage()->medium}}">
				    	</a>
						{{$post->content}}
					</div>
				@if(($i == 2) && (count($cat_news) > 3))
					<a href="{{route('cat.news.show', $cat->alias)}}" class="my-btn right z-depth-2 deep-purple lighten-2 white-text waves-effect waves-purple "><i class="material-icons">chevron_right</i></a>
				@endif
				@php($i++)
				@endforeach
			@endif
		</div>
		@endif
		@if(($cat_images) && (count($cat_images) > 3))
		<h6 class="cat-title light-blue-text text-darken-1">Світлини</h6>
		<div class="row">
			@for($i=0; $i<3; $i++)
				<div class="col xl4 l4 m4 s4">
					<a href="{{$cat_images[$i]->large}}" class="imageSingle">
						<img id="main-img" class="responsive-img" src="{{$cat_images[$i]->medium}}"/>
					</a>
				</div>
				@if(($i == 2) && (count($cat_images) > 3))
					<a href="{{route('cat.images.show', $cat->alias)}}" class="my-btn right z-depth-2 deep-purple lighten-2 white-text waves-effect waves-purple "><i class="material-icons">chevron_right</i></a>
				@endif
			@endfor
		</div>
		@endif
		@if($cat_video_data)
		<h6 class="cat-title light-blue-text text-darken-1">Нове відео</h6>
		<div class="row">
			@if(count($cat_video_data) == 1)
						<div class="col xl6 l6 m6 s12 thumb">
							<span class="cat-title grey-text text-darken-2">{{$cat_video_data[0]['title']}}</span>
								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$cat_video_data[0]['id']}}?autoplay=true">
									<img id="main-img" class="responsive-img" src="{{$cat_video_data[0]['thumb']}}">
									<img class="youtube-logo" src="{{asset('img')}}/yt_logo_mono_dark.png">
								</a>
						</div>
			@else
					@for($i=0; $i<2; $i++)
						<div class="col xl6 l6 m6 s6 thumb">
							<span class="cat-title grey-text text-darken-2 span-mobile">{{$cat_video_data[$i]['title']}}</span>
								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$cat_video_data[$i]['id']}}?autoplay=true">
									<img id="main-img" class="responsive-img" src="{{$cat_video_data[$i]['thumb']}}">
									<img class="youtube-logo youtube-logo-mobile" src="{{asset('img')}}/yt_logo_mono_dark.png">
								</a>
						</div>
					@if(($i == 1) && (count($cat_video_data) > 2))
						<a href="{{route('cat.videos.show', $cat->alias)}}" class="my-btn right z-depth-2 deep-purple lighten-2 white-text waves-effect waves-purple "><i class="material-icons">chevron_right</i></a>
					@endif
					@endfor
			@endif
		</div>
		@endif
		<div class="fb-like" data-href="{{env('APP_URL')}}/{{$cat->alias}}" data-width="50" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true" data-colorscheme="light"></div>
		<div class="fb-comments" data-href="{{env('APP_URL')}}/{{$cat->alias}}" data-numposts="5"
				data-colorscheme="light" data-mobile="true" data-order-by="reverse_time"></div>
	</div>
</div>