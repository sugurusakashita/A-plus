@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.core.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/aplus_style.css') }}">
@stop

@section('title')
FAQ | A+plus
@stop

@section('main_content')
<div class="accordion">
	<h1>FAQ</h1>
	<p></p>
  <ul>
    <li>
      <span class="toggle btn">A+plusとは何ですか？</span>
      <ul style="display:none;">
        <li>早稲田大学非公認アプリケーション開発サークルです。<br>詳しくは<a href="/about">こちら</a>をご覧ください。</li>
      </ul>
    </li>
    <li>
      <span class="toggle btn">退会方法は？</span>
      <ul style="display:none;">
        <li style="color:red">
        	退会されると、今までのレビューなどのデータも全て削除されます。<br>利用に関しては無料なので、利用されない場合でも会員継続をお勧め致します。</li><br>
        <li>それでも退会される場合は<a href="/auth/delete-account">こちら</a>からご退会ください。</li>
      </ul>
    </li>
    <li>
      <span class="toggle btn">サイトの動作が上手くいかない。バグがあった。</span>
      <ul style="display:none;">
        <li>ご迷惑おかけしております。今後のサービス向上のために問題をご報告いただけますでしょうか？<br>お手数ですが、<a href="/inquiry">こちらのフォーム</a>から問題を報告してください。</li><br>
      </ul>
    </li>
  </ul>
</div>
@stop

@section('js')
<script type="text/javascript">
	$(function () {
	  $(".accordion .toggle").click(function () {
	    $(this).next("ul").slideToggle(200);
	    $(this).toggleClass("open");
  });
});
</script>
@stop
