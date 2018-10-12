<div class="my-card-panel green lighten-2 white-text z-depth-2">
	<h6>{{$post->category->title}}</h6>
</div>
<span class="my-date">{{$post->getDate()}}</span>
	<div class="row">
			<div class="col xl4 l4 m4 s4">
				<a href="{{$post->getImage()->large}}" class="imageSingle">
		    		<img id="main-img" class="responsive-img" src="{{$post->getImage()->medium}}">
		    	</a>
	  		</div>
			<div class="col xl8 l8 m8 s8">
				{{$post->content}}
			</div>
	</div>

	@if($pics)
		@include('pages.gallery')
	@endif

	@if($post->video)
	<div class="row">
	    <div class="col xl6 l6 m6 s12 thumb">
	     	<span class="cat-title grey-text text-darken-2">{{$post_video_data['title']}}</span>
				<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$post_video_data['id']}}?autoplay=true">
					<img id="main-img" class="responsive-img" src="{{$post_video_data['thumb']}}">
					<img class="youtube-logo" src="{{asset('img')}}/yt_logo_mono_dark.png">
				</a>
	    </div>
	</div>
	@endif
	<div class="fb-comments" data-href="{{env('APP_URL')}}/news/{{$post->id}}" data-numposts="5"
		data-colorscheme="light" data-mobile="true" data-order-by="reverse_time"></div>