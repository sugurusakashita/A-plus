@extends('master')

@section('title')
授業レビュー | {{ $data['detail']['class_name']}} | レビュー確認
@stop

@section('main_content')
<h3 class="page-header">レビュー確認 | {{ $data['detail']['class_name']}}</h3>
<form action="/classes/complete" method="POST">
	<table class="table table-bordered">
	  <thead>
	    <tr>
	      <th>受講時の学年</th>
	      <th>受講時の年度</th>
	      <th>総合評価度</th>
          <th>単位の取りやすさ</th>
          <th>GP(成績)の取りやすさ</th>
          <th>出席</th>
          <th>最終評価方法</th>
          <?php echo $data['final_evaluation'] == "期末試験"? '<th>期末試験の持ち込み</th>':'' ?>
	      <th>現在の講師と異なる</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
			<td>
				{{ $data['grade'] }}年{{ $data['grade'] == 5? "生以上":""}}
			</td>
			<td>
				{{ $data['year'] }}年度
			</td>
			<td>
				{{ $data['stars'] }}
			</td>
			<td>
				{{ $data['unit_stars'] }}
			</td>
			<td>
				{{ $data['grade_stars'] }}
			</td>
			<td>
				{{ $data['attendance'] }}
			</td>
			<td>
				{{ $data['final_evaluation'] }}
			</td>	
				<?php if($data['final_evaluation'] == "期末試験"){
					echo $data['bring'] == "1"? "<td>可</td>":"<td>不可</td>";
				}else{
					$data['bring'] = 0;
				}?>
			<td>
					{{ $data['diff_teacher'] == 1? "はい":"いいえ" }}
			</td>
	    </tr>
	  </tbody>
	</table>
	<div class="panel panel-default" style="margin: 25px 0;">
	 <div class="panel-title">
		授業の感想
	 </div>
	 <div class="panel-body">
	  {{ $data['review_comment'] }}
	 </div>
	</div>

	<input type="hidden" name="class_id" value="{{ $data['class_id'] }}">
	<input type="hidden" name="grade" value="{{$data['grade']}}">
	<input type="hidden" name="year" value="{{$data['year']}}">
	<input type="hidden" name="review_comment" value="{{$data['review_comment']}}">
	<input type="hidden" name="stars" value="{{$data['stars']}}">
	<input type="hidden" name="unit_stars" value="{{$data['unit_stars']}}">
	<input type="hidden" name="grade_stars" value="{{$data['grade_stars']}}">
	<input type="hidden" name="attendance" value="{{$data['attendance']}}">
	<input type="hidden" name="final_evaluation" value="{{$data['final_evaluation']}}">
	<input type="hidden" name="bring" value="{{$data['bring']}}">
	<input type="hidden" name="diff_teacher" value="{{$data['diff_teacher']}}">

	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-primary">投稿する</button>
	<button class="btn btn-default"><a href="{{ $_SERVER['HTTP_REFERER'] }}">書き直す</a></button>
</form>
@stop