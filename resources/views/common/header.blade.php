<header class="nav">
  <div class="container">
    <div class="row-fluid">
      <div class="brand">
        <a href="/" style="padding:0;"><img src="{{ asset('image/Aplus_logo_global_trans@2x.png') }}" alt="a+plus_global_logo" width=120></a>
          <form action="/search" method="get" class="left-float header-search-form">
            <input type="text" class="form-element-sm form-element" size="40" placeholder="授業名・教師名・キーワードで検索！" name="q" />
            <button class="icon-search search-icon"></button>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
          </form>
        <!-- </span> -->
      </div>
      <nav class="right-float" style="padding-top:3px;">
<!--         <a href="/" class="btn-pill">TOPページ</a>
        <a href="{{ url('/search/')}}" class="btn-pill">授業レビュー</a> -->
<!--         <a href="{{ url('/search/')}}" class="btn-pill">検索</a> -->
        @if (Auth::guest())
          <a href="{{ url('/auth/register') }}" class="btn btn-pill btn-primary">新規登録</a>
          <a href="{{ url('/auth/login') }}" class="btn btn-pill btn-primary">ログイン</a>
        @else
          <a href="/mypage/index" class="btn-pill" >{{ Auth::user()->name }} <span class="caret"></span></a>
          <a href="{{ url('/auth/logout') }}" class="btn btn-pill btn-primary">ログアウト</a>
        @endif
      </nav>
    </div>

  </div>
</header>
