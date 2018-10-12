@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
<div class="container">
  <div class="center-align">
    <a href="{{route('admin')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">адмінка</a>
  </div>
<div class="row valign-wrapper">
        <a href="{{route('admin')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-floating"><i class="material-icons">arrow_back</i></a>
      <h6 class="MyTab">Категорї</h6>
    </div>
	<div class="row admin-table">
	<table>
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Назва</th>
                  <th>Текст</th>
                  <th>Картінка</th>
                  <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                @if($cats)
                @foreach ($cats as $cat)
                <tr>
                  <td class="td-in-admin">{{ $cat->id }}</td>
                  <td class="td-in-admin">
                    <a href="{{ route('category.edit', $cat->id) }}">
                      {{ $cat->title }}
                    </a>
                  </td>
                  <td class="td-in-admin">
                      {{ substr($cat->content, 0, 50) }}...
                  </td>
                  <td  class="td-in-admin">
                  @if($cat->image)
                  <a href="{{$cat->getImage($cat->image)->large}}" class="imageSingle">
	                 <img id="main-img" src="{{ $cat->getImage($cat->image)->small }}" class="thumb-admin">
                  </a>
                  @endif
                  </td>
                  <td class="td-in-admin">
					         <a href="{{ route('category.edit', $cat->id) }}"><i class="material-icons">edit</i></a>
                  </td>
                </tr>
                @endforeach
                @endif
                </tbody>
    </table>
	</div>
</div>
@endsection