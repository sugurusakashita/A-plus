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
        <a href="/"><img src="{{ asset('image/header-logo.png') }}" alt="a+plus_global_logo" height="45"></a>
          <form action="/search" method="get" class="left-float header-search-form" id="header-search-box">
            <input type="text" class="form-element-sm form-element" size="40" placeholder="授業名・教師名・キーワードで検索！" name="q" />
            <button class="icon-search search-icon"></button>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
          </form>
        <!-- </span> -->
      </div>
      <nav class="right-float right-nav" style="padding:0.8rem">
<!--         <a href="{{ url('/search/')}}" class="btn-pill">検索</a> -->
          <span class="common-right-header">
              <a href="{{ url('/auth/login') }}" class="btn btn-primary"><span class="icon-unlock-stroke"></span> ログイン</a>
              <a href="{{ url('/auth/register') }}" class="btn  btn-success">新規登録</a>
          </span>
          <span class="pc-menu">
            @if (!Auth::guest())
              <a href="/mypage/index" class="btn btn-info" ><span class="icon-user"></span> {{  Auth::user()->name}}<span class="caret"></span></a>
              <a href="{{ url('/auth/logout') }}" class="btn btn-danger"><span class="icon-lock-fill"></span> ログアウト</a>
            @endif
          </span>
        <div class="sp-menu" style="display:none">
          <a href="#drawer-menu" class="menu-link">&#9776;</a>
          <div id="drawer-menu" class="panel" role="navigation" style="z-index:1;">
              <ul class="text-center">
              @if (Auth::guest())
                <li>
                  <form action="/search" method="get" style="margin:7% 0;">
                    <div class="form-element-group">
                      <input type="text" class="form-element" placeholder="授業検索！" name="q"/>
                      <span class="form-group-btn">
                        <button class="btn btn-default btn-primary" type="submit">検索</button>
                      </span>
                    </div>
                      <input type="hidden" name="faculty" value="人間科学部">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                  </form>
                  <a href="{{ url('/auth/login') }}" class="btn btn-primary drawer-content"><span class="icon-unlock-stroke"></span> ログイン</a>
                  <a href="{{ url('/auth/register') }}" class="btn  btn-success drawer-content">新規登録</a>
                </li>
              @else
                <li style="margin-bottom:6%;">
                  <img src="{{ Auth::user()->avatar ?:'image/dummy.png' }}" width="100" style="display:block; margin:6% auto;" >
                  <span>{{ Auth::user()->name }}</span>
                  <form action="/search" method="get" style="margin:10% 0;">
                    <div class="form-element-group">
                      <input type="text" class="form-element" placeholder="授業名で検索！" name="q"/>
                      <span class="form-group-btn">
                        <button class="btn btn-default btn-primary" type="submit">検索</button>
                      </span>
                    </div>
                      <input type="hidden" name="faculty" value="{{ Auth::user()->faculty }}">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                  </form>
                </li>
              @endif
              <li><a href="/" class="drawer-content"><span class="icon-home"></span> Home</a></li>
              <li><a href="/mypage/index" class="drawer-content" ><span class="icon-user"></span> MyPage<span class="caret"></span></a></li>
              <li><a href="/about" class="drawer-content"><span class="icon-plus"></span> About A+plus</a></li>
              <li><a href="/help/inquiry" class="drawer-content"><span class="icon-mail4"></span> Contact us</a></li>
              @if(!Auth::guest())
                <li><a href="{{ url('/auth/logout') }}" class="btn btn-danger drawer-content"><span class="icon-lock-fill"></span> ログアウト</a></li>
              @endif
              </ul>
          </div>
        </div>
      </nav>
    </div>

  </div>
</header>
