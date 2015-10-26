@extends('full')

@section('title')
レビュー編集 | {{ $review->classes()->first()->class_name }} |  確認 | A+plus
@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

@section('js')
<link rel="stylesheet" href="/raty_lib/jquery.raty.css">
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
@stop

@section('main_content')
<div class="panel panel-primary">
  <div class="panel-title header-font">レビュー編集 | {{ $review->classes()->first()->class_name }} |  確認 </div>
  <div class="panel-body">
	<form action="/mypage/edit-complete" method="POST">
		<div class="row-fluid">
		        <div class="col6">
		          <table class="table table-bordered" >
		            <tbody>
		                <tr>
		                    <th>総合 <span class="warning-text">※必須</span></th>
		                    <td class="raty-readonly" data-number="{{ $review->stars }}"></td>
		                </tr>
		                <tr>
		                  <th>単位の取りやすさ <span class="warning-text">※必須</span></th>
		                  <td class="raty-readonly" data-number="{{ $review->unit_stars }}"></td>
		                </tr>
		                  <tr>
		                    <th>GP(成績)の取りやすさ <span class="warning-text">※必須</span></th>
		                    <td class="raty-readonly" data-number="{{ $review->grade_stars }}"></td>
		                  </tr>
		                  <tr>
		                    <th>内容の充実度 <span class="warning-text">※必須</span></th>
		                    <td class="raty-readonly" data-number="{{ $review->fulfill_stars }}"></td>
		                  </tr>
		              </tbody>
		          </table>

		        </div>
		        <div class="col6">
		          <table class="table table-bordered">
		            <tbody>
		              <tr>
		                <th>受講した学年</th>
		                <td>{{ $grade }}年{{ $grade == 5? "生以上":""}}</td>
		              </tr>
	                  <tr>
	                    <th>出席</th>
	                    <td>{{ $attendance }}</td>
	                  </tr>
	                  @if($review->classes()->first()->exam > 0)
	                  <tr>
	                    <th>試験の持ち込み</th>
	                    <td>{{ $bring }}</td>
	                  </tr>
	                  @endif
		            </tbody>
		          </table>
		        </div>
		</div>
		<div class="panel panel-default" style="margin: 20px 0;">
		 <div class="panel-title">
			授業の感想
		 </div>
		 <div class="panel-body">
		  {{ $review_comment }}
		 </div>
		</div>

		<input type="hidden" name="class_id" value="{{  $class_id }}">
		<input type="hidden" name="grade" value="{{ $grade}}">
		<input type="hidden" name="review_comment" value="{{ $review_comment}}">
		<input type="hidden" name="stars" value="{{ $stars}}">
		<input type="hidden" name="unit_stars" value="{{ $unit_stars}}">
		<input type="hidden" name="grade_stars" value="{{ $grade_stars}}">
		<input type="hidden" name="fulfill_stars" value="{{ $fulfill_stars}}">
		<input type="hidden" name="review_id" value="{{  $review_id }}">
		<input type="hidden" name="attendance" value="{{  $attendance }}">
		@if($review->classes()->first()->exam > 0)
		<input type="hidden" name="bring" value="{{ $bring }}">
		@endif
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary">レビューを更新する</button>
		<button type="submit" class="btn btn-default" name="_return" value="1">書き直す</button>
	</form>

	</div>
</div>
@stop