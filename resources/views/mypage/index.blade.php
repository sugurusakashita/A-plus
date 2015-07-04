@extends('master')

@section('title')
A+plus
@stop

@section('main_content')
	<p>ユーザー名</p>
	<hr>
	<p>{{ $data['user']->name }}</p>
	<hr>
	<p>レビュー履歴</p>
	<hr>
	@if(!$data['reviews']->count())
	<p style='color:#FF0000;'>まだレビューされていません。</p>
	@else 
	<table class="table table-striped table-hover">
		<thead>
			<tr>
			<th>授業名</th>
			<th>レビュー</th>
			<th>総合評価度</th>
			<th>単位の取りやすさ</th>
			<th>GP(成績)の取りやすさ</th>
			</tr>
		</thead>
		<tbody>
	    @foreach($data['reviews'] as $review)
	    	<tr>
	    		<td>{{{ $review->classes()->first()->class_name }}}</td>
	         	<td>{{{ $review->review_comment }}}</td>
	         	<td>{{{ $review->stars }}}</td>
	         	<td>{{{ $review->unit_stars }}}</td>
	         	<td>{{{ $review->grade_stars }}}</td>
	         	<td>
					<!-- <a href="/classes/show/" class="btn btn-default btn-xs">詳細</a> -->
					<form action="/classes/edit" method="get">
						<input type="hidden" value="{{{ $review->review_id }}}" name="review_id">
						<input type="hidden" name="_token" value="{{csrf_token()}}" />
						<button type="submit" class="btn btn-success btn-xs" />編集</button>
			        </form>
			        <form action="/classes/delete-confirm" method="POST">
			          	<input type="hidden" value="{{{ $review->review_id }}}" name="review_id">
			          	<input type="hidden" name="_token" value="{{csrf_token()}}" />
			          	<button type="submit" class="btn btn-danger btn-xs">削除</button>
			         </form>
	  			</td>
	 		</tr>
 		@endforeach
  @endif
		</tbody>
	</table>
@stop