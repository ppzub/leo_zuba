	<div class="container">
		<div class="row">
			<div class="col xl9 l9 m12 s12">
				<div class="my-card-panel deep-purple lighten-2 white-text z-depth-2">
					<h6>Результати пошуку: {{$count}}</h6>
				</div>
					@if($count == 0)
						<div class="row">
							<div class="col xl12 l12 m12 s12 center">
								<h5>Нічого не знайдено</h5>
							</div>
						</div>
					@endif
					@if(!$cats->isEmpty())
						@foreach($cats as $cat)
						<div class="row">

							<div class="col xl4 l4 m4 s5">
								<a class="my-img-link" href="{{route('cat.show', $cat->alias)}}">
						    		<img class="responsive-img my-img-link" src="{{$cat->getImage()->medium}}">
						    	</a>
					  		</div>

							<div class="col xl8 l8 m8 s7">
								<div class="my-title">{{$cat->title}}</div>
								{{ mb_substr($cat->content, 0, 80) }}...
							</div>
						</div>
						@endforeach
					@endif
					@if(!$posts->isEmpty())
						@foreach($posts as $post)
						<div class="row">

							<div class="col xl4 l4 m4 s5">
								<a class="my-img-link" href="{{route('post.show', $post->id)}}">
						    		<img class="responsive-img my-img-link" src="{{$post->getImage()->medium}}">
						    	</a>
					  		</div>

							<div class="col xl8 l8 m8 s7">
								{{ mb_substr($post->content, 0, 80) }}...
								<div class="my-date">{{$post->getDate()}}</div>
							</div>
						</div>
						@endforeach
					@endif
			</div>
			<div class="col xl3 l3 m6 s12 my-sidebar">
			<div class="my-card-panel deep-purple lighten-2 white-text z-depth-2">
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