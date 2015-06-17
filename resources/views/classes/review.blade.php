@extends('master')

@section('title')
授業レビュー | {{ $data['detail']['class_name'] }}
@stop

@section('main_content')
<h3 class="page-header">レビュー入力 | {{ $data['detail']['class_name']}}</h3>
<form action="/classes/confirm" method="POST">

	<table class="table table-bordered" style="margin: 20px auto;">
	  <thead>
	    <tr>
	      <th>受講時の学年</th>
	      <th>受講時の年度</th>
	      <th>評価度</th>
	      <th>現在の講師と異なる</th>
	    </tr>
	  </thead>
    <tbody>
      <tr>
        <td>
        	<select name="grade" class="form-control">
        		<option value="1">1年生</option>
        		<option value="2">2年生</option>
        		<option value="3">3年生</option>
        		<option value="4">4年生</option>
        		<option value="5">5年生以上</option>
        	</select>
        </th>
        <td>
        	<select name="year" class="form-control">
        		<option value="2011">2011年度</option>
        		<option value="2012">2012年度</option>
        		<option value="2013">2013年度</option>
        		<option value="2014">2014年度</option>
        		<option value="2015">2015年度</option>
        	</select>
        </th>
        <td>
        	<select name="stars" class="form-control">
        		<option value="1">☆1</option>
        		<option value="2">☆2</option>
        		<option value="3">☆3</option>
        		<option value="4">☆4</option>
        		<option value="5">☆5</option>
        	</select>
        </th>
        <td>
			<div class="radio-btn">
			  <label>
					<input type="radio" value="1" name="diff_teacher" />
			    はい
			  </label>
			</div>
			<div class="radio-btn">
			  <label>
					<input type="radio" value="0" name="diff_teacher" checked />
			    いいえ
			  </label>
			</div>
        </th>
      </tr>
    </tbody>
	</table>
	<div class="form-group">
		<label>授業の感想</label>
		<textarea placeholder="50字以上、500字以下で入力してください。" name="review_comment" rows="4" required class="form-control form-element"></textarea>
	</div>
	<input type="hidden" name="class_id" value="{{ $data['detail']->class_id }}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-primary">入力を確認する</button>
	<button class="btn btn-default"><a href="{{ $_SERVER['HTTP_REFERER'] }}">戻る</a></button>
</form>
@stop