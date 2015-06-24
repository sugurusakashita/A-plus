@extends('master')

@section('title')
授業レビュー | 再編集レビュー確認
@stop

@section('main_content')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">レビュー確認</h2>
			<form action="/classes/edit-complete" method="POST">
				<div class="form-group">
					<label>受講時の学年</label>
					{{ $data['grade'] }}年{{ $data['grade'] == 5? "生以上":""}}
				</div>
				<div class="form-group">
					<label>受講時の年度</label>
					{{ $data['year'] }}年度
				</div>
				<div class="form-group">
					<label>授業の感想</label>
					<div>
					{{ $data['review_comment'] }}
					</div>
				</div>
				<div class="form-group">
					<label>評価度</label>
					{{ $data['stars'] }}
				</div>
				<div class="form-group">
					<label>単位の取りやすさ</label>
					{{ $data['unit_stars'] }}
				</div>
				<div class="form-group">
					<label>GP(成績)の取りやすさ</label>
					{{ $data['grade_stars'] }}
				</div>
				<div class="form-group">
					<label>現在の講師と異なる</label>
					<p>はい</p>{{ $data['diff_teacher'] == 1? "●":"○" }}
					<p>いいえ</p>{{ $data['diff_teacher'] == 0? "●":"○" }}<br>
				</div>
				<input type="hidden" name="review_id" value="{{ $data['review_id'] }}">
				<input type="hidden" name="class_id" value="{{ $data['class_id'] }}">
				<input type="hidden" name="grade" value="{{$data['grade']}}">
				<input type="hidden" name="year" value="{{$data['year']}}">
				<input type="hidden" name="review_comment" value="{{$data['review_comment']}}">
				<input type="hidden" name="stars" value="{{$data['stars']}}">
				<input type="hidden" name="unit_stars" value="{{$data['unit_stars']}}">
				<input type="hidden" name="grade_stars" value="{{$data['grade_stars']}}">
				<input type="hidden" name="diff_teacher" value="{{$data['diff_teacher']}}">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<button type="submit" class="btn btn-default">投稿する</button>
			</form>
		</div>
	</div>
</div>
@stop