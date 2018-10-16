<div class="container">
<h6>Вітаємо в продюсерській!</h6>
	<div class="row row-in-admin">

		<div class="col xl2 l2 m6 s12 col-in-admin"><a href="{{route('posts.create')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">+ новий запис</a></div>
		<div class="col xl2 l2 m6 s12 col-in-admin"><a href="{{route('edit.category.show')}}" class="deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">редагувати категорії</a></div>
    <div class="col xl4 l4 m6 s12 col-in-admin input-field">
          <select onchange="location = this.value;">
            <option value="{{route('admin')}}">Всі категорії</option>
            @if($cats)
              @foreach($cats as $cat)
                @if ((isset($alias)) && ($cat->alias == $alias))
                  <option value="{{route('posts.show', $cat->alias)}}" selected>{{$cat->title}}</option>
                @else
                  <option value="{{route('posts.show', $cat->alias)}}">{{$cat->title}}</option>
                @endif
              @endforeach
            @endif
          </select>
    </div>
		<div class="col xl4 l4 m6 s12">
      <my-nav>
        <div class="my-nav-wrapper green lighten-2">
            <form method="GET" action="{{route('admin.search')}}">
              <div class="input-field my-input-field">
                <input name="key" id="search" type="search" required>
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form>
          </div>
      </my-nav>
		</div>

	</div>

	<div class="row admin-table">
@if(isset($count) && ($count == 0))
  <div class="col xl12 l12 m12 s12 center">
    <h5>Нічого не знайдено</h5>
  </div>
@else
	<table>
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Текст</th>
                  <th>Категорія</th>
                  <th>Картінка, фото-галерея</th>
                  <th>Відео</th>
                  <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                @if($posts)
                @foreach ($posts as $post)
                <tr>
                  <td class="td-in-admin">{{ $post->id }}</td>
                  <td class="td-in-admin">
                    <a href="{{ route('posts.edit', $post->id) }}">
                      {{ substr($post->content, 0, 20) }}...
                    </a>
                  </td>
                  @if ($post->category)
                  <td class="td-in-admin">
                  		{{ $post->category->title}}
                  </td>
                  @elseif(!$post->category)
                  	<td  class="td-in-admin opa-in-admin">Немає категорії</td>
                  @endif
                  <td  class="td-in-admin">
                  @if($post->image)
                  <a href="{{$post->getImage()->large}}" class="imageSingle">
	                 <img id="main-img" src="{{ $post->getImage()->small }}" class="thumb-admin">
                  </a>
	              @else
	              	<span class="opa-in-admin">Немає картінки</span>
                  @endif
                  		@if(!$post->galleries->isEmpty())
                    		<br>Тут є фото-галерея, <a href="{{route('gallery.edit', $post->id)}}">редагувати</a>
                      @else
                        <br>Нема фото-галереї, <a href="{{route('gallery.create', $post->id)}}">СТВОРИТИ</a>
                    	@endif
                  </td>
                  	@if($post->video)
                  		<td class="thumb td-in-admin">
          								<a class="lightBoxVideoLink" href="https://www.youtube.com/embed/{{$post->getVideoData()['id']}}?autoplay=true">
          									<img id="main-img" class="thumb-admin" src="{{$post->getVideoData()['thumb']}}">
          								</a><br>
          								<span>{{$post->getVideoData()['title']}}</span>
          						</td>
          					@else
          						<td  class="td-in-admin opa-in-admin">Немає відоса</td>
                  	@endif

                  <td class="td-in-admin">
					         <a href="{{ route('posts.edit', $post->id) }}"><i class="material-icons">edit</i></a>
                  	{{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) }}
                        <button onclick="return(confirm('Дійсно видалити цей пост?'))" type="submit" class="delete-task admin-delete">
                        <i class="material-icons">delete</i>
                        </button>
                    {{ Form::close() }}
                  </td>
                </tr>
                @endforeach
                </tbody>
    </table>

		          <div class="my-paginator">{{ $posts->links('layouts.paginate') }}</div>
              @endif
@endif
	</div>
</div>