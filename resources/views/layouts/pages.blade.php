@include('layouts.menu-with-logo')
@if (isset($news) && isset($sidebar_video_data))
	@include('pages.news')
@elseif (isset($cats) && isset($posts) && isset($sidebar_video_data))
	@include('pages.search')
@else
	<div class="container">
		<div class="row">
			<div class="col xl9 l9 m12 s12">
				{!! $main_content !!}
			</div>
			<div class="col xl3 l3 m12 s12 my-sidebar">
				<div class="my-card-panel green lighten-2 white-text z-depth-2">
					<h6>останні новини</h6>
				</div>
				@include('layouts.sidebar')
			</div>
		</div>
	</div>
@endif