<header class="nav" style="padding: 5px 0; margin: 0 0 10px; background-color:rgba(255,0,0,0.26)">
  <div class="container">
    <div class="row-fluid">
      <div class="brand">
        <a href="/" style="padding:0;"><img src="{{ asset('image/A+plus_logo_global_trans@2x.png') }}" alt="a+plus_global_logo" width=120></a>
      </div>
      <nav class="right-float" style="padding-top:3px;">
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
