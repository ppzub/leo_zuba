@if($sidebar_posts)
@foreach($sidebar_posts as $post)
	<a class="sidebar-link" href="{{route('post.show', $post->id)}}">
		<div class="one-sidebar">
			@if($post->image)
				<img class="responsive-img my-thumb-img" src="{{$post->getImage()->small}}">
			@endif
			<div class="text-sidebar">
				<div>{{ mb_substr($post->content, 0, 50) }}...</div>
				<div class="my-date">{{$post->getDate()}}</div>
			</div>
		</div>
	</a>
@endforeach
@endif
<a href="{{route('news.show')}}" class="right deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">більше новин</a>
<div class="pusto"></div>