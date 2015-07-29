@extends('master')

@section('title')
授業レビュー　|　完了
@stop

@section('main_content')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">レビュー編集確認</h2>
			<p>レビューの編集が完了しました。</p>
			<a href="/classes/index/{{ $data['id'] }}">授業ページに戻る</a>
		</div>
	</div>
</div>
@stop