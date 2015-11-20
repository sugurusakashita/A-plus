@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
A+plusについて | A+plus
@stop

@section('main_content')
<div class="panel panel-warning">
 <div class="panel-title">
   早稲田授業レビューサイト「A+plus」について
 </div>
 <div class="panel-body">
  <div class="text-center">
    <img class="news-header-image" src="image/about/about-site.png" alt="早稲田授業レビューサイト「A+plus」について">
  </div>
  テキトーに履修登録したら、学年末ぐらいになって、レポートが3000字！試験が超難しい！
  <b>「受講するんじゃなかった…」</b>と後悔したことありませんか？<br>
  <br>
  A+plusでは、「大学生活をスマートに」をミッションに、皆様の履修登録を支援します。
  現在は、所沢キャンパスのみの授業を扱っておりますが、<b>今後は他キャンパスも対応していく予定です。</b>
  「ここが使いにくい」「こういう機能が欲しい！」といった苦情、ご要望もお受けいたしております。<br>
  <br>
  お手数ですが、<a href="/help/inquiry">こちらのページ</a>から送信してください。
 </div>
</div>
<br />
<div class="panel panel-warning">
  <div class="panel-title">
    早稲田大学アプリケーション開発サークル「A+plus」について
  </div>
  <div class="panel-body">
  <div class="text-center">
    <img style="margin:3%;" src="image/ei-logo1.png" alt="アプリ開発サークル「A+plus」について" width="280">
  </div>
    A+plus（エイプラス）は、2015年5月に設立された早稲田大学アプリケーション開発サークルです。<br>
    <br>
    本サークルは、早稲田大学所沢キャンパスをメインキャンパスとする学生エンジニアが集結して
    「何か面白いものをつくろう」をテーマに発足した、所キャン初！アプリケーション開発サークルです！<br>
    A+plusでは常に、「ものづくりが大好き」なメンバーを募集しております。プログラミング経験なしでも、もちろん大丈夫！<br>
    <br>
    ご興味のある方は、<a href="https://twitter.com/waseda_Aplus">公式Twitter</a>へDMかリプライを！！<br>
  </div>
</div>
@stop
