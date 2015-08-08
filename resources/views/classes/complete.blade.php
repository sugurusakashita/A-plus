@extends('master')

@section('title')
授業レビュー　|　完了
@stop

@section('main_content')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">レビュー投稿完了</h2>
			<p>投稿が完了しました。</p>
			<a href="/classes/index/{{ $data['id'] }}"><button type="button" class="btn btn-default">授業ページに戻る</button></a>
			
		</div>
	</div>
</div>
@stop