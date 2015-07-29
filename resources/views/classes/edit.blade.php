@extends('master')

@section('js')
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
@stop

@section('title')
レビュー再編集 | {{ $data['detail']->classes()->first()->class_name }}
@stop

@section('main_content')
<h3 class="page-header">レビュー再編集 | {{ $data['detail']->classes()->first()->class_name }} </h3>
<form action="/classes/edit-confirm" method="POST">
	<table class="table table-bordered" style="margin: 20px auto;">
	   <thead>
		    <tr>
				<th>受講時の学年</th>
				<th>受講時の年度</th>
				<th>総合評価度</th>
				<th>単位の取りやすさ</th>
				<th>GP(成績)の取りやすさ</th>
				<th>出席</th>
				<th>最終評価方法</th>
				<th class="bring" style="display:none;">期末試験の持ち込み</th>        
				<th>現在の講師と異なる</th>
		    </tr>
	  	</thead>
	    <tbody>
	      	<tr>
	        	<td>
	        		<select name="grade" class="form-control">
						<option value="1" {{{ $data['detail']['grade'] == 1? "selected":"" }}}>1年生</option>
						<option value="2" {{{ $data['detail']['grade'] == 2? "selected":"" }}}>2年生</option>
						<option value="3" {{{ $data['detail']['grade'] == 3? "selected":"" }}}>3年生</option>
						<option value="4" {{{ $data['detail']['grade'] == 4? "selected":"" }}}>4年生</option>
						<option value="5" {{{ $data['detail']['grade'] == 5? "selected":"" }}}>5年生以上</option>
					</select>
		        </td>
		        <td>
					<select name="year" class="form-control">
						<option value="2011" {{{ $data['detail']['year'] == 2011? "selected":"" }}} >2011年度</option>
						<option value="2012" {{{ $data['detail']['year'] == 2012? "selected":"" }}} >2012年度</option>
						<option value="2013" {{{ $data['detail']['year'] == 2013? "selected":"" }}} >2013年度</option>
						<option value="2014" {{{ $data['detail']['year'] == 2014? "selected":"" }}} >2014年度</option>
						<option value="2015" {{{ $data['detail']['year'] == 2015? "selected":"" }}} >2015年度</option>
					</select>
		        </td>
		        <td>
					<select name="stars" class="form-control">
						<option value="1" {{{ $data['detail']['stars'] == 1? "selected":"" }}} >☆1</option>
						<option value="2" {{{ $data['detail']['stars'] == 2? "selected":"" }}} >☆2</option>
						<option value="3" {{{ $data['detail']['stars'] == 3? "selected":"" }}} >☆3</option>
						<option value="4" {{{ $data['detail']['stars'] == 4? "selected":"" }}} >☆4</option>
						<option value="5" {{{ $data['detail']['stars'] == 5? "selected":"" }}} >☆5</option>
					</select>
		        </td>
		        <td>
					<select name="unit_stars" class="form-control">
						<option value="1" {{{ $data['detail']['unit_stars'] == 1? "selected":"" }}} >☆1</option>
						<option value="2" {{{ $data['detail']['unit_stars'] == 2? "selected":"" }}} >☆2</option>
						<option value="3" {{{ $data['detail']['unit_stars'] == 3? "selected":"" }}} >☆3</option>
						<option value="4" {{{ $data['detail']['unit_stars'] == 4? "selected":"" }}} >☆4</option>
						<option value="5" {{{ $data['detail']['unit_stars'] == 5? "selected":"" }}} >☆5</option>
					</select>
		        </td>
		        <td>
					<select name="grade_stars" class="form-control">
						<option value="1" {{{ $data['detail']['grade_stars'] == 1? "selected":"" }}} >☆1</option>
						<option value="2" {{{ $data['detail']['grade_stars'] == 2? "selected":"" }}} >☆2</option>
						<option value="3" {{{ $data['detail']['grade_stars'] == 3? "selected":"" }}} >☆3</option>
						<option value="4" {{{ $data['detail']['grade_stars'] == 4? "selected":"" }}} >☆4</option>
						<option value="5" {{{ $data['detail']['grade_stars'] == 5? "selected":"" }}} >☆5</option>
					</select>
		        </td>
		        <td>
		            <select name="attendance" class="form-control">
		                <option value="常に取る" 	 {{{ $data['detail']['attendance'] == "常に取る"? "selected":"" }}}>常に取る</option>
		                <option value="たまに取る" {{{ $data['detail']['attendance'] == "たまに取る"? "selected":"" }}}>たまに取る</option>
		                <option value="取らない" 		 {{{ $data['detail']['attendance'] == "取らない"? "selected":"" }}}>取らない</option>
		            </select>
		        </td>
		        <td>
		            <select name="final_evaluation" class="form-control">
		                <option value="期末試験" {{{ $data['detail']['final_evaluation'] == "期末試験"? "selected":"" }}}>期末試験</option>
		                <option value="期末レポート" {{{ $data['detail']['final_evaluation'] == "期末レポート"? "selected":"" }}}>期末レポート</option>
		                <option value="その他" {{{ $data['detail']['final_evaluation'] == "その他"? "selected":"" }}}>その他</option>
		            </select>
		        </td>
		        <td class="bring" style="display:none;">
		            <select name="bring" class="form-control">
		                <option value="1" {{{ $data['detail']['bring'] == "1"? "selected":"" }}}>可</option>
		                <option value="0" {{{ $data['detail']['bring'] == "0"? "selected":"" }}}>不可</option>        
		            </select>
		        </td>
		        <td>
					<div class="radio-btn">
					  <label>
							<input type="radio" value="1" name="diff_teacher" {{{ $data['detail']['diff_teacher'] == 1? "checked":"" }}}/>
					    はい
					  </label>
					</div>
					<div class="radio-btn">
					  <label>
							<input type="radio" value="0" name="diff_teacher" {{{ $data['detail']['diff_teacher'] == 0? "checked":"" }}} />
					    いいえ
					  </label>
					</div>
		        </td>
		    </tr>
	    </tbody>
	</table>
	<div class="form-group">
		<label>授業の感想</label>
		<textarea placeholder="例) 大学生活において必要なスキルを学ぶための授業。レポートの正しい書き方、Macbookの使い方などを学ぶ。先生はおおらかな人なので遅刻は厳しくない。しかし、声が小さく、スライドも文字が小さいので理解しにくい。最終レポートは1000字だが、出せば単位は来る" name="review_comment" rows="4" required class="form-control form-element">{{{ $data['detail']['review_comment'] }}}</textarea>
	</div>
	<input type="hidden" name="review_id" value="{{ $data['detail']->review_id }}">
	<input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-default">入力を確認する</button>
	<button class="btn btn-default"><a href="{{ @$_SERVER['HTTP_REFERER'] }}">戻る</a></button>
</form>

@stop