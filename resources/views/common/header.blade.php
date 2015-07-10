<header class="nav" style="margin: 30px 0;">
  <div class="container">
    <div class="row-fluid">
      <div class="brand">
        <a href="/" class=""><img src="/image/Aplus.png" style="width:200px; height:auto;"></a>
      </div>
      <nav class="right-float">
        <a href="/" class="btn-pill">TOPページ</a>
        <a href="{{ url('/search/')}}" class="btn-pill">授業レビュー</a>
<!--         <a href="{{ url('/search/')}}" class="btn-pill">検索</a> -->
        @if (Auth::guest())
          <a href="{{ url('/auth/register') }}" class="btn btn-pill btn-primary-outline">新規登録</a>
          <a href="{{ url('/auth/login') }}" class="btn btn-pill btn-primary-outline">ログイン</a>
        @else
          <a href="/mypage/index" class="btn-pill" >{{ Auth::user()->name }} <span class="caret"></span></a>
          <a href="{{ url('/auth/logout') }}" class="btn btn-pill btn-primary-outline">ログアウト</a>
        @endif
      </nav>
    </div>

  </div>
</header>
