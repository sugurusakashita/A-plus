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
    @include('common.header')
  <div id="main-content" class="container">
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