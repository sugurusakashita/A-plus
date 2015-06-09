@extends('master')

@section('title')
授業レビュー | レビュー削除確認
@stop

@section('main_content')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">レビュー削除確認</h2>
			<form action="/classes/delete-complete" method="POST">
				<div class="form-group">
					<label>受講時の学年</label>
					{{ $data['detail']['grade'] }}年{{ $data['detail']['grade'] == 5? "生以上":""}}
				</div>
				<div class="form-group">
					<label>受講時の年度</label>
					{{ $data['detail']['year'] }}年度
				</div>
				<div class="form-group">
					<label>授業の感想</label>
					<div>
					{{ $data['detail']['review_comment'] }}
					</div>
				</div>
				<div class="form-group">
					<label>評価度</label>
					{{ $data['detail']['stars'] }}
				</div>
				<div class="form-group">
					<label>現在の講師と異なる</label>
					<p>はい</p>{{ $data['detail']['diff_teacher'] == 1? "●":"○" }}
					<p>いいえ</p>{{ $data['detail']['diff_teacher'] == 0? "●":"○" }}<br>
				</div>
				<input type="hidden" name="review_id" value="{{ $data['review_id'] }}">
				<input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
				<input type="hidden" name="grade" value="{{$data['detail']['grade']}}">
				<input type="hidden" name="year" value="{{$data['detail']['year']}}">
				<input type="hidden" name="review_comment" value="{{$data['detail']['review_comment']}}">
				<input type="hidden" name="stars" value="{{$data['detail']['stars']}}">
				<input type="hidden" name="diff_teacher" value="{{$data['detail']['diff_teacher']}}">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<button type="submit" class="btn btn-default">削除する</button>
			</form>
		</div>
	</div>
</div>
@stop