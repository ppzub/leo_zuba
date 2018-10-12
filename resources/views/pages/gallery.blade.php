	@if(count($pics) < 7)
		@for($i=0; $i<count($pics); $i++)
			@if (count($pics) == 1)
				@if($i == 0)
					<div class="row">
				@endif
				<div class="col xl12 l12 m12 s12">
					<a href="{{$pics[$i]->large}}" class="imageSingle">
						<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
					</a>
				</div>
			@elseif (count($pics) == 2)
				@if($i == 0)
					<div class="row">
				@endif
				<div class="col xl6 l6 m6 s6">
					<a href="{{$pics[$i]->large}}" class="imageSingle">
						<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
					</a>
				</div>
			@elseif (count($pics) == 3)
				@if($i == 0)
					<div class="row">
				@endif
				<div class="col xl4 l4 m4 s4">
					<a href="{{$pics[$i]->large}}" class="imageSingle">
						<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
					</a>
				</div>
			@elseif (count($pics) == 4)
				@if(($i == 0) || ($i == 2))
					<div class="row imageGallery">
				@endif
						<div class="col xl6 l6 m6 s6">
							<a href="{{$pics[$i]->large}}">
								<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
							</a>
						</div>
				@if(($i == 1) || ($i == 3))
					</div>
				@endif
			@elseif (count($pics) == 5)
				@if(($i == 0) || ($i == 2))
					<div class="row imageGallery">
				@endif
					@if($i < 2)
						<div class="col xl6 l6 m6 s6">
							<a href="{{$pics[$i]->large}}">
								<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
							</a>
						</div>
					@else
						<div class="col xl4 l4 m4 s4">
							<a href="{{$pics[$i]->large}}">
								<img id="main-img" class="responsive-img " src="{{$pics[$i]->medium}}"/>
							</a>
						</div>
					@endif
				@if(($i == 1) || ($i == 4))
					</div>
				@endif
			@elseif (count($pics) == 6)
				@if(($i == 0) || ($i == 3))
					<div class="row imageGallery">
				@endif
						<div class="col xl4 l4 m4 s4">
							<a href="{{$pics[$i]->large}}">
								<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
							</a>
						</div>
				@if(($i == 2) || ($i == 5))
					</div>
				@endif
			@endif
			@if(($i == count($pics) - 1) && (count($pics) < 4))
				</div>
			@endif
		@endfor
	@else
			@for($i=0, $j=2; $i<count($pics); $i++)
				@if(($i == 0) || ($i%3 == 0))
					<div class="row imageGallery">
				@endif
					<div class="col xl4 l4 m4 s4">
						<a href="{{$pics[$i]->large}}">
							<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
						</a>
					</div>
				@if (($i == $j) || ($i == count($pics) - 1))
				@php($j+=3)
					</div>
				@endif
			@endfor
    @endif