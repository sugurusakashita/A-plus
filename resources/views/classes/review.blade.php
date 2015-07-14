@extends('master')

@section('title')
授業レビュー | {{ $data['detail']['class_name'] }}
@stop

@section('js')
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
@stop
@section('main_content')
<h3 class="page-header">レビュー入力 | {{ $data['detail']['class_name']}}</h3>
<form action="/classes/confirm" method="POST">
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
                <option value="">選択してください</option>
        		<option value="1">1年生</option>
        		<option value="2">2年生</option>
        		<option value="3">3年生</option>
        		<option value="4">4年生</option>
        		<option value="5">5年生以上</option>
        	</select>
        </td>
        <td>
        	<select name="year" class="form-control">
                <option value="">選択してください</option>
        		<option value="2011">2011年度</option>
        		<option value="2012">2012年度</option>
        		<option value="2013">2013年度</option>
        		<option value="2014">2014年度</option>
        		<option value="2015">2015年度</option>
        	</select>
        </td>
        <td>
        	<select name="stars" class="form-control">
                <option value="">選択してください</option>
        		<option value="1">☆1</option>
        		<option value="2">☆2</option>
        		<option value="3">☆3</option>
        		<option value="4">☆4</option>
        		<option value="5">☆5</option>
        	</select>
        </td>
        <td>
            <select name="unit_stars" class="form-control">
                <option value="">選択してください</option>
                <option value="1">☆1</option>
                <option value="2">☆2</option>
                <option value="3">☆3</option>
                <option value="4">☆4</option>
                <option value="5">☆5</option>
            </select>
        </td>
        <td>
            <select name="grade_stars" class="form-control">
                <option value="">選択してください</option>
                <option value="1">☆1</option>
                <option value="2">☆2</option>
                <option value="3">☆3</option>
                <option value="4">☆4</option>
                <option value="5">☆5</option>
            </select>
        </td>
        <td>
            <select name="attendance" class="form-control">
                <option value="">選択してください</option>
                <option value="常に取る">常に取る</option>
                <option value="たまに取る">たまに取る</option>
                <option value="取らない">取らない</option>
            </select>
        </td>
        <td>
            <select name="final_evaluation" class="form-control">
                <option value="">選択してください</option>
                <option value="期末試験">期末試験</option>
                <option value="期末レポート">期末レポート</option>
                <option value="その他">その他</option>
            </select>
        </td>
        <td class="bring" style="display:none;">
            <select name="bring" class="form-control">
                <option value="">選択してください</option>
                <option value="1">可</option>
                <option value="0">不可</option>
                
            </select>
        </td>
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
        </td>
      </tr>
    </tbody>
	</table>
	<div class="form-group">
		<label>授業の感想</label>
		<textarea placeholder="例) 大学生活において必要なスキルを学ぶための授業。レポートの正しい書き方、Macbookの使い方などを学ぶ。先生はおおらかな人なので遅刻は厳しくない。しかし、声が小さく、スライドも文字が小さいので理解しにくい。最終レポートは1000字だが、出せば単位は来る" name="review_comment" rows="4" required class="form-control form-element"></textarea>
	</div>
	<input type="hidden" name="class_id" value="{{ $data['detail']->class_id }}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-primary">入力を確認する</button>
	<button class="btn btn-default"><a href="{{ $_SERVER['HTTP_REFERER'] }}">戻る</a></button>
</form>
@stop