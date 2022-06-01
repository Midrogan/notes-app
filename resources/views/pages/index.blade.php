@extends('layouts.main-layout')
@section('title', 'Note')
@section('content')
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container d-flex justify-content-between align-items-center" style="max-width: 1160px;">

      {{-- <div class="bg-dark shadow-sm rounded-3 p-2">
        <a href="{{route('index')}}"><img class="icon" src="/img/logo.png" alt=""></a>
      </div> --}}
      <a href="{{route('index')}}"><img class="icon" src="/img/blogo.png" alt=""></a>

      <div>
        @if (Route::has('login'))
          @auth
            <a href="{{ url('/notes') }}" type="button" class="btn btn-sm btn-dark shadow-sm">Личный кабинет</a>
          @else
            @if (Route::has('register'))
              <a href="{{ route('register') }}" type="button" style="background-color: rgb(255, 255, 255)" class="btn btn-sm btn-light shadow-sm me-2">Регистрация</a>
            @endif
            <a href="{{ route('login') }}" type="button" class="btn btn-sm btn-dark shadow-sm">Войти</a>
          @endauth
        @endif
      </div>
    </div>
  </nav>


  <div class="pt-4">
    <div class="container pt-4" style="max-width: 1160px;">
  
    <div class="row">
      <div class="col-lg-5 col-12 d-flex flex-column justify-content-between align-items-center mb-4 p-4 1rounded-3 1shadow-sm" style="1background-color: #ffffff;">
        <img class="mb-4" width="100" height="100" src="/img/sticky-note.png" alt="">
        <div class="mb-4">
          <h1 class="text-center mb-2">
            Держите все важное под рукой
          </h1>
          <h6 class="text-center">
            Соберите идеи в одном месте с помощью бесплатных онлайн заметок.
          </h6>
        </div>
        <div class="mb-4">
          <a href="{{ route('register') }}" type="button" class="btn btn-lg btn-dark shadow-sm">Начало работы</a>
        </div>
        <div class="row justify-content-between">

          <div class="col-2">
            <a href="https://html.spec.whatwg.org/multipage/">
              <img class="" width="32" height="32" src="/img/html-logo.png" alt="">
            </a>
          </div>

          <div class="col-2">
            <a href="https://drafts.csswg.org/">
              <img class="" width="32" height="32" src="/img/css-logo.png" alt="">
            </a>
          </div>

          <div class="col-2">
            <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript">
              <img class="" width="32" height="32" src="/img/javascript-logo.png" alt="">
            </a>
          </div>

          <div class="col-2">
            <a href="https://getbootstrap.com/docs/5.0/getting-started/introduction/">
              <img class="" width="40" height="32" src="/img/bootstrap-logo.svg" alt="">
            </a>
          </div>

          <div class="col-2">
            <a href="https://laravel.com/docs/9.x/installation">
              <img class="" width="32" height="32" src="/img/laravel-logo.png" alt="">
            </a>
          </div>

        </div>
      </div> 
      
      <div class="col-lg-7 col-12">
        <div class="row" data-masonry='{"percentPosition": true }'>

          <div class="col-sm-6 col-12 mb-4">
            <div class="card rounded-3 shadow-sm unclickable">
              <div class="card-body"> 
                <h5 class="card-title">Храните идеи</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Ведение заметок заставляет гораздо внимательнее смотреть на окружающий мир.</p>
              </div>
              <div class="card-tag-list border-top">
                <div class="card-tag tag-blue shadow-sm unclickable">Возможности</div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-12 mb-4">
            <div class="card rounded-3 shadow-sm unclickable">
              <div class="card-body"> 
                <h5 class="card-title">Составляйте списки</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Пусть список дел станет списком сделанного.</p>
              </div>
              <div class="card-tag-list border-top">
                <div class="card-tag tag-pink shadow-sm unclickable">Возможности</div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-12 mb-4">
            <div class="card rounded-3 shadow-sm unclickable">
              <div class="card-body"> 
                <h5 class="card-title">Пусть от заметок будет больше толка</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Добавляйте изображение к своим заметкам и спискам.</p>
              </div>
              <div class="card-tag-list border-top">
                <div class="card-tag tag-light-green shadow-sm unclickable">Возможности</div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-12 mb-4">
            <div class="card rounded-3 shadow-sm unclickable">
              <div class="card-body"> 
                <h5 class="card-title">Заметкам и спискам необходима связь</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Создавайте свои собственные категории необходимого цвета и группируйте идеи.</p>
              </div>
              <div class="card-tag-list border-top">
                <div class="card-tag tag-turquoise shadow-sm unclickable">Возможности</div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-12 mb-4">
            <div class="card rounded-3 shadow-sm unclickable">
              <div class="card-body"> 
                <h5 class="card-title">Ничего не теряйте</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Архивируйте свои заметки и списки чтобы затем к ним вернуться.</p>
              </div>
              <div class="card-tag-list border-top">
                <div class="card-tag tag-orange shadow-sm unclickable">Возможности</div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-12 mb-4">
            <div class="card rounded-3 shadow-sm unclickable">
              <div class="card-body"> 
                <h5 class="card-title">Работайте в любом месте</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Ваши заметки одинаково удобно использовать с любого устройства.</p>
              </div>
              <div class="card-tag-list border-top">
                <div class="card-tag tag-light-blue shadow-sm unclickable">Возможности</div>
              </div>
            </div>
          </div>


        </div>
      </div>

    </div>
  
    </div>
  </div>

    </div>
  </div>
@endsection

@section('scripts')
<script>

  $('.scrollto a').on('click', function() {

    let href = $(this).attr('href');

    $('html, body').animate({
        scrollTop: $(href).offset().top
    }, {
        duration: 100,  
        easing: "linear"
    });

    return false;
  });

</script>
@endsection
{{-- <div class="row">
  <div class="col-xl-4 col-md-6 col-12">
    <a class="btn btn-primary" href="{{route('notes')}}">Заметки</a>
  </div>
  <div class="col-xl-4 col-md-6 col-12">
    <div class="logo border-bottom d-inline-flex d-flex flex-column p-3">
      <a href="{{route('index')}}"><img class="" width="100px" height="100px" src="/img/logo.png" alt=""></a>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 col-12">
    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/notes') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ Auth::user()->name }}</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div>
  @endif
  </div>
</div> --}}


