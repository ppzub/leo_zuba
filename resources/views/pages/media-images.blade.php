	<div class="row">
		<div class="col xl12 l12 m12 s12 imageGallery">

			@foreach ($media as $k => $cat)
				@if (!$cat->posts->isEmpty())
					<div class="my-card-panel deep-purple lighten-2 white-text z-depth-2">
						<h6>{{ $cat->title }}: світлини</h6>
					</div>

					@php($j = 2)
					@php($i = 0)
					@foreach ($images[$k] as $img)
						@if(($i == 0) || ($i%3 == 0))
							<div class="row">
						@endif
						<div class="col xl4 l4 m4 s4">
							<a href="{{$img->large}}">
								<img id="main-img" class="responsive-img" src="{{$img->medium}}"/>
							</a>
						</div>
						@if (($i == $j) || ($i == count($images[$k]) - 1))
							@php($j = $j + 3)
								</div>
						@endif
					@php($i++)
					@endforeach

				@endif
			@endforeach
		</div>
	</div>

