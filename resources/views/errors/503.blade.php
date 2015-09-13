@extends('full')

@section('title')
現在、サーバーに負荷がかかっています | A+plus
@stop


@section('main_content')
<div id="content">
  <div class="panel panel-danger">
    <div class="panel-title">
      503 Error! | Service Unavailable
    </div>
    <div class="panel-body">
      <p>現在、サーバーに負荷がかかっているか、サーバーメンテナンス中です。<br>一時的にサービスをご利用できません。今しばらく待ってからアクセスをしてください。</p>
    </div>
  </div>
  <div class="section-margin">
    <a href="/"><button type="button" class="btn btn-default">トップページへ</button></a>
  </div>
</div>
@stop