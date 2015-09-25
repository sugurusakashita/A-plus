<!-- facebook SDK START-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4&appId=1017018984977481";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- facebook SDK END -->
<header class="nav">
  <div class="container">
    <div class="row-fluid">
      <div class="brand">
        <a href="/" style="padding:0;"><img src="{{ asset('image/header-logo.png') }}" alt="a+plus_global_logo" height="45"></a>
          <form action="/search" method="get" class="left-float header-search-form" id="header-search-box">
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
          <a href="/mypage/index" class="btn-pill btn-primary" >{{ Auth::user()->name }} <span class="caret"></span></a>
          <a href="{{ url('/auth/logout') }}" class="btn btn-pill btn-primary">ログアウト</a>
        @endif
      </nav>
    </div>

  </div>
</header>
