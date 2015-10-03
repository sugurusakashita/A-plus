@extends('top')

@section('title')
早稲田大学所沢キャンパス 授業レビューサイト A+plus
@stop

@section('meta')
<meta name="description" itemprop="description" content="大学生活をさらにスマートに。さらに賢く。" />
<meta name="keywords" itemprop="keywords" content="A+plus,早稲田,所沢キャンパス,所キャン,大学" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="早稲田大学所沢キャンパス授業レビューサイト A+plus" />
<meta name="twitter:iamge" content="{{ asset('image/top/top-main.gif') }}" />
<meta property="og:title" content="A+plus トップページ" />
<meta property="og:url" content="{{ url() }}" />
<meta property="og:image" content="{{ asset('image/meta/logo550.gif') }}" />
<meta property="og:site_name" content="早稲田大学所沢キャンパス授業レビューサイト A+plus" />
<meta property="og:description" content="A+plusでは早稲田大学所沢キャンパスの授業レビューを提供しています。" />
<meta itemprop="image" content="{{ asset('image/meta/logo550.gif') }}" />
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="/css/sublimeSlideshow.css">
@stop

@section('main_content')
<div class="header-field">
     <img class="bland_img" src="{{ asset('image/top/top-main.gif') }}" alt="a+plus_logo">
  <div class="search_header">
    <form action="/search" method="get">
      <div class="form-element-group top-faculty-form">
          <span class="form-element-extra">学部</span>
          <select class="form-element" name="faculty">
            <option>人間科学部</option>
            <option>スポーツ科学部</option>
          </select>
      </div>
      <div class="form-element-group">
        <input type="text" class="form-element" placeholder="授業名・教師名・キーワードで検索！" name="q"/>
        <span class="form-group-btn">
          <button class="btn btn-default btn-primary" type="submit">検索</button>
        </span>
      </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>
  </div>
</div>
<div class="left">
  <div class="container">
    <div class="row-fluid">
      <div class="top-content text-center">
         <div class="top-block">
          <h2>ABOUT A+plus</h2>
          <hr>
          <div>
            <p class="lead">A+plusは、早稲田大学所沢キャンパスの授業レビューサービスを提供しております。</p>
            <p>多くの人に「後悔しない履修登録」をしていただくため、当サービスは2015年9月12日より開始いたしました。</p>
            <p>当サービスは<b>完全無料</b>です。まずは<b><a href="/auth/register">こちらから無料会員登録</a></b>してご利用ください！</p>
            <p>また、履修済みの授業に関してはレビューしていただけませんでしょうか？次に履修する人が<b>あなたのレビューを待ってます。</b></p>
            <p>更にA+plusについて詳しく知りたい方は<a href="/about">こちらから！</a></p>
          </div>
        </div>
        <div class="top-block">
          <div>
          <h2>SERVICE</h2>
          <hr>
          </div>
          <div class="col12">
            <div class="col6 text-left">
              <p class="lead">早稲田大学所沢キャンパスの授業レビューを見たり、書いたりできます！</p>
              <p>詳しい使い方は<a href="/help/manual">こちら</a>をご覧ください。</p>
              <p>サイト上部、またはTOPページの検索ボックスから授業名、教師名、キーワードで検索！<br>検索は「曜日」「時限」「学期」から絞ることもできます。<br>授業ページではその授業の評価方法が円グラフで表示されます。</p>
            </div>
            <div class="col6">
              <img class="top-content-img" src="/image/top/top-service1.png" alt="A+plus service1" style="width:100%">
            </div>
          </div>
        </div>
        <div class="top-block">
          <h2>ABOUT US</h2>
          <hr>
          <img class="top-content-img" src="/image/ei-logo1.png" alt="A+plus service1" height="250">
          <p class="lead">当サービスは早稲田大学非公認アプリケーション開発サークル「A+plus」によって運営されています。</p>
          <p>本サークルは2015年5月に発足いたしました。今後も様々なサービスやアプリケーションを発信していく予定です。<br>詳しくは<a href="/about">こちらから！</a>(入会希望者もこちらから)</p>
        </div>
    </div>
  </div>
</div>
@stop

@section('js')
    <script type="text/javascript" src="/js/jquery.sublimeSlideshow.js"></script>
    <script type="text/javascript">
    //スライドショー用
    $(function(){
        var device = ($(window).width() < 1021)? "sp":"pc";
        $.sublime_slideshow({
          src:[
          {url:"/image/top/top-"+device+"-img1.jpg",title:""},
          {url:"/image/top/top-"+device+"-img2.jpg",title:""},
          {url:"/image/top/top-"+device+"-img3.jpg",title:""},
          {url:"/image/top/top-"+device+"-img4.jpg",title:""},
          {url:"/image/top/top-"+device+"-img5.jpg",title:""},
          ],
          duration:   7,
          fade:       1,
          scaling:    false,
          rotating:   false,
          overlay:    "image/pattern.png"
        });
    });
    </script>
    <script type="text/javascript">
      //アラートメッセージ用
      <?php
      if($v = $data["message"]){
          echo "alertify.success('".$v."');";
      }
      if($v = $data["alert"]){
          echo "alertify.error('".$v."');";
      }
      ?>
    </script>
@stop