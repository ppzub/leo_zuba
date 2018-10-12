@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')

<!-- START ВЕСІЛЛЯ ПІД КЛЮЧ -->
@include('index.vesillia')
<!-- END ВЕСІЛЛЯ ПІД КЛЮЧ -->

<!-- START PARALLAX -->
@include('index.parallax')
<!-- END PARALLAX -->

<!-- START МЕНЮ КАРУСЕЛЬ -->
@include('index.menu-carousel')
<!-- END МЕНЮ КАРУСЕЛЬ -->

<!-- START PARALLAX -->
@include('index.parallax')
<!-- END PARALLAX -->

<!-- START Останні новини -->
@include('index.last-news')
<!-- END Останні новини -->

@endsection

@section('footer')
  @include('layouts.footer')
@endsection