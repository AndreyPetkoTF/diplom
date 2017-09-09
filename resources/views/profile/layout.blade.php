<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/profile.css') }}">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<input type="hidden" value="{{csrf_token()}}" id="token"></input>
 <div class="header-line"></div>
 <div class="container">
   <div class="header">
    <div class="row">
      <div class="col-lg-3 col-md-5 col-sm-5 col-xs-9">
        <a href="/profile">
          <div class="logo-img">
            <img src="{{ url('/profile_images/logo-sm.png') }}" alt="">
          </div>
          <div class="logo-text hidden-xs">
            IT - ШКОЛА <br> ИРИНЫ БУЗИКОВОЙ
          </div>
        </a>
      </div>
      <div class="col-lg-8 col-lg-offset-1 hidden-md hidden-sm hidden-xs">  
        <div class="menu">
         <a href="/">
          <div class="menu-item">
           На сайт
         </div>
       </a>
       <a href="{{ url('profile') }}">
         <div class="menu-item">
           Главная
         </div>
       </a>


       <a href="{{ url('/profile/consultations') }}">
         <div class="menu-item">
           Консультации
         </div>
       </a>


       <a href="{{ url('/profile/discussions') }}">
         <div class="menu-item">
          <div class="new-info">{{$consultationCount}}</div>
          Обсуждения
        </div>
      </a>

      <a href="{{ url('/news-list') }}">
        <div class="menu-item">
          Новости
        </div>
      </a>

      <a href="{{ url('/profile/personal') }}">
       <div class="menu-item">
         Личный кабинет
       </div>
     </a>

     <a href="{{ url('/auth/logout') }}">
       <div class="menu-item">
         Выход
       </div>
     </a>
   </div>
 </div>
 <div class="hidden-lg col-md-2 col-md-offset-4  col-sm-2 col-sm-offset-4 col-xs-2 ">
  <div class="hamburger">
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
  </div>
</div>
</div>
</div> 
</div>
<!--        header-->

<!--       mobile-menu-->
<div class="mobile-menu">
 <div class="mobile-menu-item">
   На сайт
 </div>
 <a href="{{ url('/profile') }}">
   <div class="mobile-menu-item">
     Главная
   </div>
 </a>

 <a href="./konsultatsii.html">
   <div class="mobile-menu-item">
     Консультации
   </div>
 </a>


 <a href="./obsugdenie.html">
   <div class="mobile-menu-item">
     Обсуждения
   </div>
 </a>

 <div class="mobile-menu-item">
   Новости
 </div>

 <a href="./lichnui.html">
   <div class="mobile-menu-item">
     Личный кабинет
   </div>
 </a>
</div>

<div class="container">
  @yield('content')
</div>
</div>

<div class="footer">
  <div class="footer-line"></div>

  <div class="footer-text">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti magni, corporis quos saepe distinctio facere placeat impedit temporibus accusantium harum? 
  </div>

  <div class="footer-social">
   <div class="social-item">
    <img src="{{ url('/profile_images/icon-fb.png') }}" alt="">
  </div>

  <div class="social-item">
    <img src="{{ url('/profile_images/icon-vk.png') }}" alt="">
  </div>

  <div class="social-item">
    <img src="{{ url('/profile_images/icon-ok.png') }}" alt="">
  </div>

  <div class="social-item">
    <img src="{{ url('/profile_images/icon-ut.png') }}" alt="">
  </div>

  <div class="social-item">
    <img src="{{ url('/profile_images/icon-insta.png') }}" alt="">
  </div>

  <div class="social-item">
    <img src="{{ url('/profile_images/icon-tv.png') }}" alt="">
  </div>

  <div class="social-item">
    <img src="{{ url('/profile_images/icon-google.png') }}" alt="">
  </div>
</div>
</div>
<script src="{{ url('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ url('dist/js/profile.js') }}"></script>
<script src="{{ url('dist/js/sova.js') }}"></script>
@yield('js')
</body>
</html>