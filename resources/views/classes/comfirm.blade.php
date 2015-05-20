@extends('master')

@section('title')
授業レビュー | レビュー確認
@stop

@section('body')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">レビュー削除確認</h2>
		<form action="/classes/review" method="POST">
			<div class="form-group">
			<lavel>受講時の学年</lavel>
			<p>受講時の年度</p>
			<p>授業の感想</p>
			<div>
			</div>
			<p>評価度</p>
			<p>現在の講師と異なる</p>
			<p>はい</p>
			<p>いいえ</p>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<button type="submit" class="btn btn-default">投稿する</button>
			</div>
		</form>
		</div>
	</div>
</div>
@stop