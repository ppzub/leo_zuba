<div class="row">
	<div class="col xl12 l12 m12 s12 imageGallery">
		@if($cat_images_show)
		<div class="my-card-panel deep-purple lighten-2 white-text z-depth-2">
			<h6>{{ $cat->title }}: світлини</h6>
		</div>
			@for($i=0, $j=2; $i<count($cat_images_show); $i++)
				@if(($i == 0) || ($i%3 == 0))
					<div class="row">
				@endif
					<div class="col xl4 l4 m4 s4">
						<a href="{{$cat_images_show[$i]->large}}">
							<img id="main-img" class="responsive-img" src="{{$cat_images_show[$i]->medium}}"/>
						</a>
					</div>
				@if (($i == $j) || ($i == count($cat_images_show) - 1))
				@php($j+=3)
					</div>
				@endif
			@endfor
		@endif
	</div>
</div>