<!doctype>
<html lang="ja">
<head>
    @include('common.meta')
    @yield('meta')
    @yield('css')
    <title>
        @yield('title')
    </title>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4&appId=1017018984977481";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    @include('common.header')
  <div class="container">
      <div class="row-fluid">
        <div class="col9">
          @yield('main_content')
        </div>
        <div class="col3">
          @yield('sidebar')
        </div>
      </div>
  </div>
  @include('common.footer')
  <script type="text/javascript" src="{{ asset('/js/alertify.js') }}"></script>
  @yield('js')
</body>
</html>