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
    @yield('main_content')
    @include('common.footer')

<script type="text/javascript" src="{{ asset('/js/alertify.js') }}"></script>
  @yield('js')
</body>
</html>