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
			<h6 class="MyTab">	Створити ноий запис</h6>
		</div>
		@include('admin.errors')
{{ Form::open([
	'route' => 'posts.store',
	'files' => true
])}}
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	<span class="grey-text text-lighten">Основний текст *</span>
					{{Form::textarea('content', old('content'), [
						'id' => 'content',
						'class' => 'materialize-textarea'
					])}}
				</div>
			</div>
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	<span class="grey-text text-lighten">Виберіть категорію *</span>
                	@if($cats)
					    {{ Form::select('category_id', $cats, null)}}
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
					   	<input class="file-path validate grey-text text-lighten" type="text" value="Головна картінка">
					</div>
			    </div>
			</div>
			<div class="row">
                <div class="file-field input-field col xl6 l6 m6 s12">
				    <div class="btn">
				    	<span>Галерея</span>
				    	<input type="file" name="gallery[]" id="gallery" multiple>
				    </div>
					<div class="file-path-wrapper">
					   	<input class="file-path validate grey-text text-lighten" type="text" value="Кілька фото для галереї">
					</div>
			    </div>
			</div>
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	{{Form::text('video', old('video'), ['id' => 'video'])}}
                	{{Form::label('video', 'Відео з Youtube')}}
                	<span class="grey-text text-lighten">В форматі простого посилання: https://www.youtube.com/watch?v=KO8gW5qnEnk</span>
            	</div>
			</div>
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	{{Form::date('created_at', \Carbon\Carbon::now())}}
                </div>
			</div>
			<p>* Поле обов'язкове для заповнення</p>
			<div class="row">
				<div class="col xl6 l6 m6 s12">
				<button class="btn waves-effect waves-light right" type="submit">створити
					<i class="material-icons right">send</i>
				</button>
				</div>
			</div>
{{ Form::close() }}

</div>


@endsection