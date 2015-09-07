@extends('full')

@section('js')
<link rel="stylesheet" href="/raty_lib/jquery.raty.css">
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

@section('title')
レビュー編集 | {{ $data['detail']->classes()->first()->class_name }} | A+plus
@stop

@section('main_content')
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

<div class="panel panel-primary">
  <div class="panel-title header-font">レビュー編集 | {{ $data['detail']->classes()->first()->class_name }}</div>
  <div class="panel-body">
    <form action="/mypage/edit-confirm" method="POST">
      <div class="row-fluid">
                <div class="col6">
                  <table class="table table-bordered" >
                    <tbody>
                        <tr>
                            <th>総合 <span class="warning-text">※必須</span></th>
                            <td class="raty_stars" data-number="{{ old('stars')? old('stars'):$data['detail']['stars'] }}"></td>
                        </tr>
                        <tr>
                          <th>単位の取りやすさ <span class="warning-text">※必須</span></th>
                          <td class="raty_unit_stars" data-number="{{ old('unit_stars')? old('unit_stars'):$data['detail']['unit_stars'] }}"></td>
                        </tr>
                          <tr>
                            <th>GP(成績)の取りやすさ <span class="warning-text">※必須</span></th>
                            <td class="raty_grade_stars" data-number="{{ old('grade_stars')? old('grade_stars'):$data['detail']['grade_stars'] }}"></td>
                          </tr>
                          <tr>
                            <th>内容の充実度 <span class="warning-text">※必須</span></th>
                            <td class="raty_fulfill_stars" data-number="{{ old('fulfill_stars')? old('fulfill_stars'):$data['detail']['fulfill_stars'] }}"></td>
                          </tr>
                      </tbody>
                  </table>
                  <p class="right-float">☆をクリックして選択してください！</p>
                </div>
                <div class="col6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>受講した学年 <span class="warning-text">※必須</span></th>
                        <td>
                          <select name="grade">
                            <option value="1" {{ $data['detail']['grade'] === "1"? "selected":"" }}>1年</option>
                            <option value="2" {{ $data['detail']['grade'] === "2"? "selected":"" }}>2年</option>
                            <option value="3" {{ $data['detail']['grade'] === "3"? "selected":"" }}>3年</option>
                            <option value="4" {{ $data['detail']['grade'] === "4"? "selected":"" }}>4年</option>
                            <option value="5" {{ $data['detail']['grade'] === "5"? "selected":"" }}>5年以上</option>
                          </select>
                        </td>
                      </tr>
                          <tr>
                            <th>出席</th>
                            <td>
                              <ul>
                                <li><input type="radio" name="attendance" {{ $data['detail']['attendance'] === '常に取る'? 'checked':'' }} value="常に取る">常に取る</li>
                                <li><input type="radio" name="attendance" {{ $data['detail']['attendance'] === 'たまに取る'? 'checked':'' }} value="たまに取る">たまに取る</li>
                                <li><input type="radio" name="attendance" {{ $data['detail']['attendance'] === '取らない'? 'checked':'' }} value="取らない">取らない</li>
                              </ul>
                            </td>
                          </tr>
                          @if($data['detail']->classes()->first()->exam > 0)
                          <tr>
                            <th>試験の持ち込み</th>
                            <td>
                              <ul>
                                <li><input type="radio" name="bring" {{ $data['detail']['bring'] === 'レジュメ・教科書共に可'? 'checked':'' }} value="レジュメ・教科書共に可">レジュメ・教科書共に可</li>
                                <li><input type="radio" name="bring" {{ $data['detail']['bring'] === 'レジュメのみ可'?     'checked':'' }} value="レジュメのみ可">レジュメのみ可</li>
                                <li><input type="radio" name="bring" {{ $data['detail']['bring'] === '教科書のみ可'?      'checked':'' }} value="教科書のみ可">教科書のみ可</li>
                                <li><input type="radio" name="bring" {{ $data['detail']['bring'] === '不可'?        'checked':'' }} value="不可">不可</li>
                              </ul>
                            </td>
                          </tr>
                          @endif
                    </tbody>
                  </table>
                </div>
      </div>
      <div class="form-group">
        <label>授業の感想</label>
        <textarea placeholder="例) 大学生活において必要なスキルを学ぶための授業。レポートの正しい書き方、Macbookの使い方などを学ぶ。先生はおおらかな人なので遅刻は厳しくない。しかし、声が小さく、スライドも文字が小さいので理解しにくい。最終レポートは1000字だが、出せば単位は来る" name="review_comment" rows="7" required class="form-control form-element">{{ old('review_comment')? old('review_comment'):$data['detail']['review_comment'] }}</textarea>
      </div>
      <input type="hidden" name="review_id" value="{{ $data['detail']->review_id }}">
      <input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="submit" class="btn btn-primary">入力を確認する</button>
      <a href="/mypage/index"><button type="button" class="btn btn-default">マイページに戻る</button></a>
    </form>
  </div>
</div>
@stop