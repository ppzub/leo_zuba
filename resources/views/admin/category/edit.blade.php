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
		    <a href="{{route('edit.category.show')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-floating"><i class="material-icons">arrow_back</i></a>
			<h6 class="MyTab">Редагувати категорію</h6>
		</div>
		@include('admin.errors')
{{ Form::open([
		'route' => ['category.update', $cat->id],
		'files' => true,
		'method' => 'put'
])}}
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	<span class="grey-text text-lighten">Назва *</span>
					{{Form::text('title', $cat->title, [
						'id' => 'title',
						'type' => 'text',
						'class' => 'validate'
					])}}
				</div>
			</div>
			<div class="row">
                <div class="input-field col xl6 l6 m6 s12">
                	<span class="grey-text text-lighten">Текст *</span>
					{{Form::textarea('content', $cat->content, [
						'id' => 'content',
						'class' => 'materialize-textarea'
					])}}
				</div>
			</div>
            <div class="row">
            	<div class="col xl6 l6 m6 s12">
            		@if($cat->image)
            		<a href="{{$cat->getImage()->large}}" class="imageSingle">
						<img class="responsive-img my-thumb-img" src="{{$cat->getImage()->small}}">
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
					   	<input class="file-path validate grey-text text-lighten" type="text" value="Картінка категорії">
					</div>

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