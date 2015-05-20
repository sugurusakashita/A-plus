@extends('master')

@section('title')
授業レビュー | 再編集 
@stop

@section('body')
<div class ="container">
	<div class ="row">
		<div class="col-md-12">
			<h2 class="page-header">授業レビュー | 再編集</h2>
			<form action="/classes/editconfirm" method="POST">
				<div class="form-group">
					<label>受講時の学年</label>
					<select name="grade" class="form-control">

						<option value="1" {{{ $data['detail']['grade'] == 1? "selected":"" }}}>1年生</option>
						<option value="2" {{{ $data['detail']['grade'] == 2? "selected":"" }}}>2年生</option>
						<option value="3" {{{ $data['detail']['grade'] == 3? "selected":"" }}}>3年生</option>
						<option value="4" {{{ $data['detail']['grade'] == 4? "selected":"" }}}>4年生</option>
						<option value="5" {{{ $data['detail']['grade'] == 5? "selected":"" }}}>5年生以上</option>
					</select>
				</div>
				<div class="form-group">
				<label>受講時の年度</label>
					<select name="year" class="form-control">
						<option value="2011" {{{ $data['detail']['year'] == 2011? "selected":"" }}} >2011年度</option>
						<option value="2012" {{{ $data['detail']['year'] == 2012? "selected":"" }}} >2012年度</option>
						<option value="2013" {{{ $data['detail']['year'] == 2013? "selected":"" }}} >2013年度</option>
						<option value="2014" {{{ $data['detail']['year'] == 2014? "selected":"" }}} >2014年度</option>
						<option value="2015" {{{ $data['detail']['year'] == 2015? "selected":"" }}} >2015年度</option>
					</select>
				</div>

				<div class="form-group">
					<label>授業の感想</label>
					<textarea placeholder="50字以上、500字以下で入力してください。" name="review_comment" rows="4" required class="form-control">{{{ $data['detail']['review_comment'] }}}</textarea> 
				</div>
				<div class="form-group">
				<label>評価度</label>
				<select name="stars" class="form-control">
					<option value="1" {{{ $data['detail']['stars'] == 1? "selected":"" }}} >☆1</option>
					<option value="2" {{{ $data['detail']['stars'] == 2? "selected":"" }}} >☆2</option>
					<option value="3" {{{ $data['detail']['stars'] == 3? "selected":"" }}} >☆3</option>
					<option value="4" {{{ $data['detail']['stars'] == 4? "selected":"" }}} >☆4</option>
					<option value="5" {{{ $data['detail']['stars'] == 5? "selected":"" }}} >☆5</option>
				</select>
				<p>現在の講師と異なる</p>
				<p>はい</p>
				<input type="radio" value="1" name="diff_teacher"  {{{ $data['detail']['diff_teacher'] == 1? "checked":"" }}} />
				<p>いいえ
				</p><input type="radio" value="0" name="diff_teacher"  {{{ $data['detail']['diff_teacher'] == 0? "checked":"" }}} />
				</div>
				<input type="hidden" name="review_id" value="{{ $data['detail']['id'] }}">
				<input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<button type="submit" class="btn btn-default">入力を確認する</button>
				<a href="{{ $_SERVER['HTTP_REFERER'] }}">戻る</a>
			</form>
		</div>
	</div>
</div>
@stop