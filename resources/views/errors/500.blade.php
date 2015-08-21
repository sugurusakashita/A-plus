@extends('full')

@section('title')
サーバーエラー | A+plus
@stop


@section('main_content')
<div id="content">
  <div class="panel panel-danger">
    <div class="panel-title">
      500 Error! | Internal Server Error
    </div>
    <div class="panel-body">
      <p>サーバー内部でエラーが発生いたしました。</p>
      <p class="section-margin">よくある例</p>
      <ul style="font-size:14px; color:red;">
        <li>アバター画像のアップロードは2MB以下ですか？</li>
      </ul>
      <p class="section-margin">再度、アクセスをしても解決しない場合は、<a href="/help/inquiry">こちら</a>に発生したエラー内容と、その時の状況を教えていただけませんか？</p>
    </div>
  </div>
  <div class="section-margin">
    <a href="/"><button type="button" class="btn btn-default">トップページへ</button></a>
  </div>
</div>
@stop



