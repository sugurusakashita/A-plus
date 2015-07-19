<!doctype>
<html lang="ja">
<head>
    @include('common.meta')
    @yield('css')
    <title>
        @yield('title')
    </title>
</head>
<body>
    @include('common.header')
  <div class="container">
      <div class="row-fluid">
          @yield('main_content')
      </div>
  </div>
  @include('common.footer')
  @yield('js')
</body>
</html>