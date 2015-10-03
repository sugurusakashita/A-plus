<!doctype>
<html lang="ja">
<head>
    @include('common.meta')

<meta name="description" itemprop="description" content="大学生活をさらにスマートに。さらに賢く。" />
<meta name="keywords" itemprop="keywords" content="A+plus,早稲田,所沢キャンパス,所キャン,大学" />
<meta name="twitter:card" content="summary_large_image" />
<meta property="og:title" content="A+plus" />
<meta property="og:url" content="{{ url() }}" />
<meta property="og:image" content="{{ asset('image/meta/logo550.gif') }}" />
<meta property="og:site_name" content="早稲田大学所沢キャンパス 授業レビューサイト A+plus" />
<meta property="og:description" content="A+plusでは早稲田大学所沢キャンパスの授業レビューを提供しています。" />
<meta itemprop="image" content="{{ asset('image/meta/logo550.gif') }}" />

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
          @yield('main_content')
      </div>
  </div>
  @include('common.footer')
    <script type="text/javascript" src="{{ asset('/js/alertify.js') }}"></script>
  @yield('js')
</body>
</html>