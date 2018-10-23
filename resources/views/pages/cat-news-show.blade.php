<div class="row">
	<div class="col xl12 l12 m12 s12">
		@if(!$cat_news_show->isEmpty())
		<div class="my-card-panel green lighten-2 white-text z-depth-2">
			<h6>{{ $cat->title }}: новини</h6>
		</div>
			@foreach($cat_news_show as $new)
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
		@endif
	</div>
</div>