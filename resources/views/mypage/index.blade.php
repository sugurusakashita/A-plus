@extends('master')

@section('title')
A+plus
@stop

@section('css')
<style>
	#history{
		margin: 15px 0;
	}
</style>
@stop

@section('main_content')
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<p>
			入力の一部に誤りがあります。</p><br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="profile-list">
		<p>ユーザー名</p>
		<form class="name" action='#' method='POST'>
			<p class="profile-value">{{ $data['user']->name }}</p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button class="btn btn-success btn-xs edit-button" />編集</button>		
		</form>
		<hr>
	</div>
	<div class="profile-list">
		<p>登録メールアドレス</p>
		<form class="email" action='#' method='POST'>
			<p class="profile-value">{{ $data['user']->email }}</p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button class="btn btn-success btn-xs edit-button" />編集</button>
		</form>
		<hr>
	</div>
	<div class="profile-list">
		<p>入学年度</p>
		<form class="entrance_year" action='#' method='POST'>
			<p class="profile-value">{{ $data['user']->entrance_year }}</p>
			<p>年度</p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button class="btn btn-success btn-xs edit-button" />編集</button>
		</form>
		<hr>		
	</div>
	<div class="profile-list">
		<p>学部</p>
		<form class="faculty" action='#' method='POST'>
			<p class="profile-value">{{ $data['user']->faculty }}</p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button class="btn btn-success btn-xs edit-button" />編集</button>
		</form>
		<hr>		
	</div>
	<div class="profile-list">
		<p>性別</p>
		<form class="sex" action='#' method='POST'>
			<p class="profile-value">{{ $data['user']->sex }}</p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button class="btn btn-success btn-xs edit-button" />編集</button>
		</form>
		<hr>		
	</div>
	<div class="profile-list">
		<p>パスワード</p>
		<p class="profile-value">**********</p>
		<!-- Laravelの仕様？暫定。 -->
		<p>パスワードの変更は、お手数ですが一度リセットしてから再設定となります。</p>
		<a href="/password/email">こちらからメールを送信して再設定してください。</a>
		<hr>		
	</div>
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

@section('js')
	<script type="text/javascript" src="{{ asset('/js/mypage.js') }}"></script>
@stop
