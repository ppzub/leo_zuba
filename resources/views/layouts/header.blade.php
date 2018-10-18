<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper">
    <a href="{{ route('index') }}"><img class="hide-on-ipad brand-logo center" src="{{asset('img')}}/logo.png" height="60px"></a>
    <!-- start social links -->
    <div class="mynav-social-icon">
      <a href="https://www.facebook.com/Kazka.Agency.Event/">
        <img class="mynav-social-icon-img" src="{{asset('img')}}/facebook-box.png"></a>
      <a href="https://www.instagram.com/kazkaagency/">
        <img class="mynav-social-icon-img" src="{{asset('img')}}/instagram.png"></a>
      <a href="https://www.youtube.com/kazkarock">
        <img class="mynav-social-icon-img" src="{{asset('img')}}/youtube.png"></a>
    </div>
    <!-- end social links -->
      <ul id="my-left-menu" class="hide-on-med-and-down">
        <li><a href="/davnia-kazka">гурт Давня Казка</a></li>
        <li><a href="/gulianka-live-band">ГуляNка Live Band</a></li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a href="{{route('news.show')}}">Новини</a></li>
        <li><a href="{{route('videos.show')}}">Відео</a></li>
        <li><a href="{{route('images.show')}}">Світлини</a></li>
        <li><a href="{{route('reviews.show')}}">Відгуки</a></li>
        <li><i class="material-icons contact-icon">phone_iphone</i></li>
        <li class="contact">095-332-78-75</li>
      </ul>

      <a href="#" data-target="nav-mobile" class="sidenav-trigger">
        <i class="material-icons">menu</i></a>
    </div>
  </nav>
</div>
<ul id="nav-mobile" class="sidenav">
    <li><a href="/davnia-kazka">гурт Давня Казка</a></li>
    <li><a href="/gulianka-live-band">ГуляNка Live Band</a></li>
    <li><a href="/guilanka-live-and-minus">ГуляNка Live&minus</a></li>
    <li><a href="/dzi-r-dzio">Дзі-р-дзьо пародист</a></li>
    <li><a href="/sax">Саксофон на ваше свято</a></li>
    <li><a href="/mc-uzvar">Ведучий Назар Пивоварський</a></li>
    <li><a href="/liberta">show ballet liberta</a></li>
    <li><a href="/dj">Dj на свято</a></li>
    <li><a class="color-in-mobile" href="{{route('news.show')}}">Новини</a></li>
    <li><a class="color-in-mobile" href="{{route('videos.show')}}">Відео</a></li>
    <li><a class="color-in-mobile" href="{{route('images.show')}}">Світлини</a></li>
    <li><a class="color-in-mobile" href="{{route('reviews.show')}}">Відгуки</a></li>
</ul>