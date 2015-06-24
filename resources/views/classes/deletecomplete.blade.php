@extends('master')

@section('title')
授業レビュー　|　削除完了
@stop

@section('main_content')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">レビュー削除完了</h2>
		<p>レビューの削除が完了しました。</p>
		<a href="/classes/index/{{ $data['id'] }}">授業ページに戻る</a>
		</div>
	</div>

</div>
@stop