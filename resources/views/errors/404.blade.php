@extends('full')

@section('title')
存在しないページ | A+plus
@stop


@section('main_content')
<div id="content">
  <div class="panel panel-danger">
    <div class="panel-title">
      404 Error! | 存在しないページ
    </div>
    <div class="panel-body">
      <p>このページは存在しないか、削除されたページです。</p>
    </div>
  </div>
  <div class="section-margin">
    <a href="/"><button type="button" class="btn btn-default">トップページへ</button></a>
  </div>
</div>
@stop

