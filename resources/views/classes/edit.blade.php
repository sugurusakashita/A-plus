@extends('master')

@section('js')
<link rel="stylesheet" href="/raty_lib/jquery.raty.css">
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/alertify.js') }}"></script>
<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
<script>
  // 評価を星で表しています
  $(".raty_stars").raty('set', { 
  	scoreName: 'stars', 
  	score : function(){
  		return $(this).attr('data-number');
  	} 
  });
  $(".raty_unit_stars").raty('set', { 
  	scoreName: 'unit_stars',
  	score : function(){
  		return $(this).attr('data-number');
  	} 
  });
  $(".raty_grade_stars").raty('set', { 
  	scoreName: 'grade_stars',
  	score : function(){
  		return $(this).attr('data-number');
  	}  
  });
</script>
@stop

@section('title')
レビュー再編集 | {{ $data['detail']->classes()->first()->class_name }}
@stop

@section('main_content')
<h3 class="page-header">レビュー再編集 | {{ $data['detail']->classes()->first()->class_name }} </h3>
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <p>
          入力の一部に誤りがあります。</p><br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li style="color:red;">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
<form action="/classes/edit-confirm" method="POST">
	<table class="table table-bordered" style="margin: 20px auto;">
	    <tr>
	      <th scope="row">受講時の学年</th>
          <td>
            <select name="grade" class="form-control">
                <option value="">選択してください</option>
                <option value="1" {{  $data['detail']['grade'] == 1? "selected":"" }}>1年生</option>
                <option value="2" {{  $data['detail']['grade'] == 2? "selected":"" }}>2年生</option>
                <option value="3" {{  $data['detail']['grade'] == 3? "selected":"" }}>3年生</option>
                <option value="4" {{  $data['detail']['grade'] == 4? "selected":"" }}>4年生</option>
                <option value="5" {{  $data['detail']['grade'] == 5? "selected":"" }}>5年生以上</option>
            </select>
          </td>
        </tr>
        <tr>
	      <th scope="row">総合評価度</th>
          <td class="raty_stars" data-number="{{ old('stars')? old('stars'):$data['detail']['stars'] }}">
          </td>
        </tr>
        <tr>
          <th scope="row">単位の取りやすさ</th>
          <td class="raty_unit_stars" data-number="{{ old('unit_stars')? old('unit_stars'):$data['detail']['unit_stars'] }}">
          </td>
        </tr>
        <tr>
          <th scope="row">GP(成績)の取りやすさ</th>
          <td class="raty_grade_stars" data-number="{{ old('grade_stars')? old('grade_stars'):$data['detail']['grade_stars'] }}">
          </td>
        </tr>
	</table>
	<div class="form-group">
		<label>授業の感想</label>
		<textarea placeholder="例) 大学生活において必要なスキルを学ぶための授業。レポートの正しい書き方、Macbookの使い方などを学ぶ。先生はおおらかな人なので遅刻は厳しくない。しかし、声が小さく、スライドも文字が小さいので理解しにくい。最終レポートは1000字だが、出せば単位は来る" name="review_comment" rows="4" required class="form-control form-element">{{ old('review_comment')? old('review_comment'):$data['detail']['review_comment'] }}</textarea>
	</div>
	<input type="hidden" name="review_id" value="{{ $data['detail']->review_id }}">
	<input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-default">入力を確認する</button>
	<a href="/mypage/index"><button type="button" class="btn btn-default">マイページに戻る</button></a>
</form>

@stop