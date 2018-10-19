@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
<div class="container grey-text text-darken-2">
	<div class="center-align">
	  <a href="{{route('admin')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">адмінка</a>
	</div>
        <div class="row valign-wrapper">
		    <a href="{{route('admin')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-floating"><i class="material-icons">arrow_back</i></a>
			<h6 class="MyTab">	Створити галерею для даної новини</h6>
		</div>
		@include('admin.errors')
{{ Form::open([
	'route' => ['gallery.store', $post->id],
	'files' => true,
	'method' => 'post'
])}}
			<div class="row">
                <div class="file-field input-field col xl6 l6 m6 s12">
				    <div class="btn">
				    	<span>Вибрати</span>
				    	<input type="file" name="gallery[]" id="gallery" multiple>
				    </div>
					<div class="file-path-wrapper">
					   	<input class="file-path validate grey-text text-lighten" type="text" value="фоткі до галереї">
					</div>
					<button class="btn waves-effect waves-light right upload" type="submit">upload
						<i class="material-icons right">input</i>
					</button>
			    </div>
			</div>

{{ Form::close() }}
			<div class="row">
				<div class="col xl6 l6 m6 s12">
					<!--Begin-->
					@if(isset($array_of_obj) && isset($gal_ids))
	                	@for($i=0, $j=2; $i<count($array_of_obj); $i++)
							@if(($i == 0) || ($i%3 == 0))
								<div class="row">
							@endif
								<div class="col xl4 l4 m4 s4 thumb">
										<img id="main-img" class="responsive-img" src="{{$array_of_obj[$i]->medium}}"/>
									{{ Form::open([
										'method' => 'delete',
										'route' => ['gallery.destroy', $gal_ids[$i]]
									])}}
				                        <button type="submit" onclick="return(confirm('Дійсно видалити це фото?'))" class="red darken-4 white-text delete-task btn waves-effect waves-light delete-btn">
				                        <i class="material-icons">clear</i>
				                        </button>
				                    {{ Form::close() }}
								</div>
							@if (($i == $j) || ($i == count($array_of_obj) - 1))
							@php($j+=3)
								</div>
							@endif
						@endfor
					@endif
					<!--End-->
				</div>
			</div>
</div>

@endsection





