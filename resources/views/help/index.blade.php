@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
FAQ | A+plus
@stop

@section('main_content')
<div class="panel panel-warning">
 <div class="panel-title">
  <!-- <h1>FAQ</h1> -->
  FAQ
 </div>
 <div class="panel-body">
  <ul class="list-group accordion">
    <li class="list-group-element toggle">A+plusとは何ですか？</li>
    <li class="list-group-element" style="display:none;">
      早稲田大学非公認アプリケーション開発サークルです。<br>詳しくは<a href="/about">こちら</a>をご覧ください。
    </li>
    <li class="list-group-element toggle">退会方法は？</li>
    <li class="list-group-element" style="display:none;">
      退会されると、今までのレビューなどのデータも全て削除されます。<br>
      利用に関しては無料なので、利用されない場合でも会員継続をお勧め致します。<br>
      <br>
      それでも退会される場合は<a href="/auth/delete-account">こちら</a>からご退会ください。
    </li>
    <li class="list-group-element toggle">サイトの動作が上手くいかない。バグがあった。</li>
    <li class="list-group-element" style="display:none;">
      ご迷惑おかけしております。今後のサービス向上のために問題をご報告いただけますでしょうか？<br>
      お手数ですが、<a href="/help/inquiry">こちらのフォーム</a>から問題を報告してください。
    </li>
    <!-- <li class="list-group-element">This is item five</li> -->
  </ul>
 </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    $(function () {
      $("li.toggle").click(function () {
        $(this).next("li").slideToggle(200);
        $(this).toggleClass("open");
  });
});
</script>
@stop
