@extends('full')

@section('title')
認証失敗 | A+plus
@stop


@section('main_content')
<div id="content">
  <div class="panel panel-danger">
    <div class="panel-title">
      401 Error! | 認証失敗
    </div>
    <div class="panel-body">
      <p>認証に失敗しました。SNS連携等では更新ボタンを押さないでください</p>
    </div>
  </div>
  <div class="section-margin">
    <a href="/"><button type="button" class="btn btn-default">トップページへ</button></a>
  </div>
</div>
@stop

