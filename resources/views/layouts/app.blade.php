<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta property="fb:admins" content="100012346004318"/>
  <meta property="fb:admins" content="100002126122068"/>

  <meta name="robots" content="noindex, nofollow" />

  <meta itemprop="name" content="kazka agency - музика на весілля"/>
  <meta itemprop="description" content="В нас є все, щоб зробити ваше весілля найкращим! Музика і ведучий на весілля, шоу-балет, декор, фото та відеозйомка"/>
  <meta itemprop="image" content="{{asset('images/small')}}/default_small.png"/>

  <meta property="place:location:latitude" content="50.755791"/>
  <meta property="place:location:longitude" content="25.353069"/>
  <meta property="business:contact_data:locality" content="Луцьк"/>
  <meta property="business:contact_data:postal_code" content="43000"/>
  <meta property="business:contact_data:country_name" content="Україна"/>
  <meta property="business:contact_data:email" content="jenya_veryhappy@ukr.net"/>
  <meta property="business:contact_data:phone_number" content="095-332-78-75"/>
  <meta property="business:contact_data:website" content="{{route('index')}}"/>

  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{asset('/css')}}/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{asset('/css')}}/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{asset('/css')}}/magnific-popup.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{asset('/css')}}/simpleLightbox.css" type="text/css" rel="stylesheet" media="screen,projection"/>


</head>
<body>

<!-- START NAVBAR -->
@yield('header')
<!-- END NAVBAR -->
<!-- Search bar for mobile -->
      <my-nav class="col m6 s12 hide-on-large-only my-search {{(Auth::check())? 'hide' : ''}}">
        <div class="my-nav-wrapper deep-purple lighten-2">
            <form method="GET" action="{{route('search')}}">
              <div class="input-field my-input-field">
                <input name="key" id="search" type="search" required>
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
              </div>
            </form>
          </div>
      </my-nav>
<!-- END Search bar for mobile -->
@if((Auth::check()) && (Auth::user()->is_admin))
  <div class="row">
    <div class="col xl12 l12 m12 s12">
      <span class="right">Ну шо там? <b>{{Auth::user()->name}}</b>!
      <a href="{{route('admin')}}">Адмін-панель</a>
      <span>|</span>
      <a href="{{route('logout')}}">Вихід</a>
      </span>
    </div>
  </div>
@endif

@if(session('status'))
  @include('admin.status')
@endif

@yield('content')

<!-- START FOOTER -->
@yield('footer')
<!-- END FOOTER -->

  <!--  Scripts-->
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v3.1&appId=290902154820737&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="{{asset('/js')}}/materialize.js"></script>
  <script src="{{asset('/js')}}/init.js"></script>
  <script src="{{asset('/js')}}/jquery.magnific-popup.js"></script>
  <script src="{{asset('/js')}}/simpleLightbox.min.js"></script>
  </body>
</html>
