<header class="nav" style="margin: 30px 0;">
  <div class="container">
    <div class="row-fluid">
      <div class="brand">
        <a href="/" class="">A+plus</a>
      </div>
      <nav class="right-float">
        <a href="/" class="btn-pill">TOPページ</a>
        <a href="{{ url('/search/')}}" class="btn-pill">授業レビュー</a>
<!--         <a href="{{ url('/search/')}}" class="btn-pill">検索</a> -->
<!--         <a href="#" class="btn-pill">Link Three</a>
        <a href="#" class="btn-pill">Link Four</a> -->
        @if (Auth::guest())
          <a href="{{ url('/auth/register') }}" class="btn btn-pill btn-primary-outline">新規登録</a>
          <a href="{{ url('/auth/login') }}" class="btn btn-pill btn-primary-outline">ログイン</a>
        @else
          <a href="#" class="btn-pill" >{{ Auth::user()->name }} <span class="caret"></span></a>
          <a href="{{ url('/auth/logout') }}" class="btn btn-pill btn-primary-outline">ログアウト</a>
        @endif
      </nav> 
    </div>

  </div>
</header>
