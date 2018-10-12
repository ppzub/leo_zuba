@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')
  	<div class="container">
		<div class="row">
			<div class="col xl12 l12 m12 s12">
				<h1 class="grey-text text-darken-2 my-error">ERROR 404: page not found</h1>
			</div>
		</div>
		<div class="row">
			<div class="col xl12 l12 m12 s12">
				@include('index.menu-carousel')
			</div>
		</div>
	</div>
@endsection

