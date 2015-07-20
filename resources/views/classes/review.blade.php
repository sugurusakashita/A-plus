@extends('master')

@section('title')
授業レビュー | {{ $data['detail']['class_name'] }}
@stop

@section('js')
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
@stop
@section('main_content')

<div class="alert a-is-info" style="margin: 0 auto 5px;">
 <p>レビュー入力 | {{ $data['detail']['class_name']}}</p>
</div>
<form action="/classes/confirm" method="POST">
	<table class="table table-bordered" style="margin: 20px auto;">
	    <tr>
	      <th scope="row">受講時の学年</th>
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
        </tr>
        <tr>
	      <th scope="row">受講時の年度</th>
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
        </tr>
        <tr>
	      <th scope="row">総合評価度</th>
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
        </tr>
        <tr>
          <th scope="row">単位の取りやすさ</th>
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
        </tr>
        <tr>
          <th scope="row">GP(成績)の取りやすさ</th>
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
        </tr>
        <tr>
          <th scope="row">出席</th>
          <td>
              <select name="attendance" class="form-control">
                  <option value="">選択してください</option>
                  <option value="常に取る">常に取る</option>
                  <option value="たまに取る">たまに取る</option>
                  <option value="取らない">取らない</option>
              </select>
          </td>
        </tr>
        <tr>
          <th scope="row">最終評価方法</th>
          <td>
              <select name="final_evaluation" class="form-control">
                  <option value="">選択してください</option>
                  <option value="期末試験">期末試験</option>
                  <option value="期末レポート">期末レポート</option>
                  <option value="その他">その他</option>
              </select>
          </td>
        </tr>
        <tr>
          <th scope="row" class="bring" style="display:none;">期末試験の持ち込み</th>
          <td class="bring" style="display:none;">
              <select name="bring" class="form-control">
                  <option value="">選択してください</option>
                  <option value="1">可</option>
                  <option value="0">不可</option>
              </select>
          </td>
        </tr>
        <tr>
          <th scope="row">現在の講師と異なる</th>
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
	</table>
	<div class="form-group">
		<label>授業の感想</label>
		<textarea placeholder="例) 大学生活において必要なスキルを学ぶための授業。レポートの正しい書き方、Macbookの使い方などを学ぶ。&#13;&#10;先生はおおらかな人なので遅刻は厳しくない。しかし、声が小さく、スライドも文字が小さいので理解しにくい。&#13;&#10;最終レポートは1000字だが、出せば単位は来る" name="review_comment" rows="4" required class="form-control form-element"></textarea>
	</div>
	<input type="hidden" name="class_id" value="{{ $data['detail']->class_id }}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<button type="submit" class="btn btn-primary">入力を確認する</button>
	<button class="btn btn-default"><a href="{{ $_SERVER['HTTP_REFERER'] }}">戻る</a></button>
</form>
@stop