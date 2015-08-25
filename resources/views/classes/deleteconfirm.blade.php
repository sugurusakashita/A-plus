@extends('full')

@section('title')
授業レビュー | レビュー削除確認
@stop

@section('js')
<link rel="stylesheet" href="/raty_lib/jquery.raty.css">
<script type="text/javascript" src="{{ asset('/js/review.js') }}"></script>
<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
@stop

@section('main_content')
<div class="panel panel-primary">
  <div class="panel-title header-font">レビュー削除 | {{ $data['detail']->classes()->first()->class_name }} | 確認 </div>
  <div class="panel-body">
		<form action="/classes/delete-complete" method="POST">
				<div class="row-fluid">
				        <div class="col6">
				          <table class="table table-bordered" >
				            <tbody>
				                <tr>
				                    <th>総合 <span class="warning-text">※必須</span></th>
				                    <td class="raty-readonly" data-number="{{ $data['detail']['stars'] }}"></td>
				                </tr>
				                <tr>
				                  <th>単位の取りやすさ <span class="warning-text">※必須</span></th>
				                  <td class="raty-readonly" data-number="{{ $data['detail']['unit_stars'] }}"></td>
				                </tr>
				                  <tr>
				                    <th>GP(成績)の取りやすさ <span class="warning-text">※必須</span></th>
				                    <td class="raty-readonly" data-number="{{ $data['detail']['grade_stars'] }}"></td>
				                  </tr>
				                  <tr>
				                    <th>内容の充実度 <span class="warning-text">※必須</span></th>
				                    <td class="raty-readonly" data-number="{{ $data['detail']['fulfill_stars'] }}"></td>
				                  </tr>
				              </tbody>
				          </table>

				        </div>
				        <div class="col6">
				          <table class="table table-bordered">
				            <tbody>
				              <tr>
				                <th>受講した学年</th>
				                <td>{{ $data['detail']['grade'] }}年{{ $data['detail']['grade'] == 5? "生以上":""}}</td>
				              </tr>
			                  <tr>
			                    <th>出席</th>
			                    <td>{{ $data['detail']['attendance'] }}</td>
			                  </tr>
			                  @if($data['detail']['bring'])
			                  <tr>
			                    <th>試験の持ち込み</th>
			                    <td>{{$data['detail']['bring']}}</td>
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
				  {{ $data['detail']['review_comment'] }}
				 </div>
				</div>
			<input type="hidden" name="class_id" value="{{ $data['detail']['class_id'] }}">
			<input type="hidden" name="review_id" value="{{ $data['review_id'] }}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<button type="submit" class="btn btn-danger btn-xs">削除する</button>
			<a href="/mypage/index"><button type="button" class="btn btn-default">マイページに戻る</button></a>
		</form>
</div>
</div>
@stop