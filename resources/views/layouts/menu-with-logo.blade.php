<div class="container my-clear">
    <div class="row valign-wrapper my-menu-for-pages">
      <div class="col xl9 l9 m12 s12">
        <div class="carousel">
          <a class="carousel-item" href="/guilanka-live-and-minus"><img src="{{asset('img')}}/1-live-and-minus.png">
            <span class="span-mobile">ГуляNка Live&minus</span></a>
          <a class="carousel-item" href="/dzi-r-dzio"><img src="{{asset('img')}}/5-dzirdzio.png">
            <span class="span-mobile">Дзі-р-дзьо пародист<br>на мегапопулярного</span></a>
          <a class="carousel-item" href="/liberta"><img src="{{asset('img')}}/3-show-liberta.png">
            <span class="span-mobile">show ballet liberta</span></a>
          <a class="carousel-item" href="/dj"><img src="{{asset('img')}}/4-dj.png">
            <span class="span-mobile">Dj на свято</span></a>
          <a class="carousel-item" href="/mc-uzvar"><img src="{{asset('img')}}/2-veduchyi.png">
            <span class="span-mobile">Ведучий<br>Назар Пивоварський</span></a>
          <a class="carousel-item" href="/sax"><img src="{{asset('img')}}/6-sax.png">
            <span class="span-mobile">Саксофон<br>на ваше свято</span></a>
        </div>
      </div>
      <div class="col xl3 l3 hide-on-med-and-down">
        <my-nav>
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
        <img src="{{asset('img')}}/big-logo.png" class="responsive-img">
      </div>
    </div>
</div>