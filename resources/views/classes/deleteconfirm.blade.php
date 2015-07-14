@extends('master')

@section('title')
授業レビュー | レビュー削除確認
@stop

@section('main_content')
<h3 class="page-header" style="margin-bottom: 20px;">レビュー削除 | {{ $data['detail']->classes()->first()->class_name }} | 確認</h3>
<form action="/classes/delete-complete" method="POST">
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
          <?php echo $data['detail']['final_evaluation'] == "期末試験"? '<th>期末試験の持ち込み</th>':'' ?>
	      <th>現在の講師と異なる</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
			<td>
				{{ $data['detail']['grade'] }}年{{ $data['detail']['grade'] == 5? "生以上":""}}
			</td>
			<td>
				{{ $data['detail']['year'] }}年度
			</td>
			<td>
				{{ $data['detail']['stars'] }}
			</td>
			<td>
				{{ $data['detail']['unit_stars'] }}
			</td>
			<td>
				{{ $data['detail']['grade_stars'] }}
			</td>
			<td>
				{{ $data['detail']['attendance'] }}
			</td>
			<td>
				{{ $data['detail']['final_evaluation'] }}
			</td>	
				<?php if($data['detail']['final_evaluation'] == "期末試験"){
					echo $data['detail']['bring'] == "1"? "<td>可</td>":"<td>不可</td>";
				}else{
					$data['detail']['bring'] = 0;
				}?>
			<td>
					{{ $data['detail']['diff_teacher'] == 1? "はい":"いいえ" }}
			</td>
	    </tr>
	  </tbody>
	</table>
	<div class="panel panel-default" style="margin: 20px 0;">
	 <div class="panel-title">
		授業の感想
	 </div>
	 <div class="panel-body">
	  {{ $data['detail']['review_comment'] }}
	 </div>
	</div>

	<input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
	<input type="hidden" name="review_id" value="{{ $data['review_id'] }}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-danger btn-xs">削除する</button>
	<button class="btn btn-default"><a href="{{ $_SERVER['HTTP_REFERER'] }}">戻る</a></button>
</form>
@stop