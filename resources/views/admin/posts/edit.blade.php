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
			<h6 class="MyTab">Редагувати запис</h6>
		</div>
		@include('admin.errors')
{{ Form::open([
		'route' => ['posts.update', $post->id],
		'files' => true,
		'method' => 'put'
])}}
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	<span class="grey-text text-lighten">Основний текст *</span>
					{{Form::textarea('content', $post->content, [
						'id' => 'content',
						'class' => 'materialize-textarea'
					])}}
				</div>
			</div>
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	<span class="grey-text text-lighten">Виберіть категорію *</span>
                	@if($cats)
					    {{ Form::select('category_id', $cats, $post->category_id)}}
				    @endif
                </div>
            </div>
            <div class="row">
            	<div class="col xl6 l6 m6 s12">
            		@if($post->image)
            		<a href="{{$post->getImage()->large}}" class="imageSingle">
						<img class="responsive-img my-thumb-img" src="{{$post->getImage()->small}}">
					</a>
					@endif
            	</div>
            </div>
			<div class="row">
                <div class="file-field input-field col xl6 l6 m6 s12">
				    <div class="btn">
				    	<span>файл</span>
				    	<input type="file" name="image" id="image">
				    </div>
					<div class="file-path-wrapper">
					   	<input class="file-path validate grey-text text-lighten" type="text" value="Змінити головну картінку">
					</div>

			    </div>
			</div>
			@if($pics)
			<div class="row">
				<div class="col xl6 l6 m6 s12">
                	<!--Begin-->
                	@for($i=0, $j=5; $i<count($pics); $i++)
						@if(($i == 0) || ($i%6 == 0))
							<div class="row imageGallery">
						@endif
							<div class="col xl2 l2 m2 s2">
								<a href="{{$pics[$i]->large}}">
									<img id="main-img" class="responsive-img" src="{{$pics[$i]->medium}}"/>
								</a>
							</div>
						@if (($i == $j) || ($i == count($pics) - 1))
						@php($j+=6)
							</div>
						@endif
					@endfor
					<!--End-->
                    <a href="{{route('gallery.edit', $post->id)}}" class="btn waves-effect waves-light">РЕДАГУВАТИ ФОТО-ГАЛЕРЕЮ</a>
                </div>
			</div>
			@else
				<div class="row">
					<div class="col xl6 l6 m6 s12">
						<a href="{{route('gallery.create', $post->id)}}" class="btn waves-effect waves-light">СТВОРИТИ ФОТО-ГАЛЕРЕЮ</a>
					</div>
				</div>
			@endif
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	{{Form::text('video', $post->video, ['id' => 'video'])}}
                	{{Form::label('video', 'Відео з Youtube')}}
                	<span class="grey-text text-lighten">В форматі простого посилання: https://www.youtube.com/watch?v=KO8gW5qnEnk</span>
                	@if($post->video)
	                  	<div class="thumb td-in-admin">
	          				<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$post->getVideoData()['id']}}?autoplay=true">
	          					<img id="main-img" class="thumb-admin" src="{{$post->getVideoData()['thumb']}}">
	          				</a><br>
	          				<span>{{$post->getVideoData()['title']}}</span>
	          			</div>
          			@endif
            	</div>
			</div>
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	{{Form::date('created_at', $post->getCarbonDate())}}
                </div>
			</div>
			<p>* Поле обов'язкове для заповнення</p>
			<div class="row">
				<div class="col xl6 l6 m6 s12">
				<button class="btn waves-effect waves-light right" type="submit">update
					<i class="material-icons right">send</i>
				</button>
				</div>
			</div>
{{ Form::close() }}

</div>


@endsection