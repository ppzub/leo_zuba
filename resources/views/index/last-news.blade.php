      <div class="container">
        <div class="row">

          @if($index_posts)
          @foreach($index_posts as $post)
            <div class="col xl4 l4 m4 s12">
              <div class="card small">
                <div class="card-image">
                  <img class="responsive-img" src="{{$post->getImage()->medium}}">
                  <a href="{{route('post.show', $post->id)}}" class="btn-floating halfway-fab waves-effect waves-light green"><i class="material-icons">more_horiz</i></a>
                </div>
                <div class="card-content">
                  <p>{{ substr($post->content, 0, 60) }}...</p>
                </div>
              </div>
            </div>
        @endforeach
        @endif
        </div>
        <div class="row">
          <a href="{{route('news.show')}}" class="right deep-purple lighten-2 white-text waves-effect waves-purple btn-flat">більше новин</a>
        </div>
      </div>