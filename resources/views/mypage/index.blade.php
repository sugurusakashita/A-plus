@extends('master')

@section('title')
マイページ | A+plus
@stop

@section('css')
<style>
	.profile-list{
		margin: 15px 0;
	}
	form{
		margin:0;
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
		<div class="panel panel-default">
			<div class="panel-title">プロフィール画像</div>
			<div class="panel-body">
				<img class="profile-value" width="100" height="100" src="{{ $data['user']->avatar? asset('avatar/'.$data['user']->avatar):asset('image/dummy.png') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<a class="btn btn-sm btn-success btn-xs right-float" href="/mypage/avatar" />編集</a>
			</div>
		</div>
	</div>
	<div class="profile-list">
		<div class="panel panel-default">
			<div class="panel-title">ユーザー名</div>
			<div class="panel-body">
				<form class="name" action='#' method='POST'>
					<span class="profile-value">{{ $data['user']->name }}</span>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-sm btn-success btn-xs edit-button right-float" />編集</button>
				</form>
			</div>
		</div>
	</div>
	<div class="profile-list">
		<div class="panel panel-default">
			<div class="panel-title">登録メールアドレス</div>
			<div class="panel-body">
				<form class="email" action='#' method='POST'>
				<span class="profile-value">{{ $data['user']->email }}</span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-sm btn-success btn-xs edit-button right-float" />編集</button>
				</form>
			</div>
		</div>
	</div>
	<div class="profile-list">
		<div class="panel panel-default">
			<div class="panel-title">入学年度</div>
			<div class="panel-body">
				<form class="entrance_year" action='#' method='POST'>
				<span class="profile-value">{{ $data['user']->entrance_year }}{{ $data['user']->entrance_year == "その他"? "":"年度"  }}</span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-sm btn-success btn-xs edit-button right-float" />編集</button>
				</form>
			</div>
		</div>
	</div>
	<div class="profile-list">
		<div class="panel panel-default">
			<div class="panel-title">学部</div>
			<div class="panel-body">
				<form class="faculty" action='#' method='POST'>
				<span class="profile-value">{{ $data['user']->faculty }}</span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-sm btn-success btn-xs edit-button right-float" />編集</button>
				</form>
			</div>
		</div>
	</div>
	<div class="profile-list">
		<div class="panel panel-default">
			<div class="panel-title">性別</div>
			<div class="panel-body">
				<form class="sex" action='#' method='POST'>
				<span class="profile-value">{{ $data['user']->sex }}</span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-sm btn-success btn-xs edit-button right-float" />編集</button>
				</form>
			</div>
		</div>
	</div>
	<div class="profile-list">
		<div class="panel panel-default">
			<div class="panel-title">パスワード</div>
			<div class="panel-body">
				<span class="profile-value">**********</span>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			パスワードの変更は、お手数ですが一度リセットしてから再設定となります。<br />
			<a href="/password/email">こちらからメールを送信して再設定してください。</a>
		</div>
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
  <?php echo old("message"); ?>
		</tbody>
  
	</table>
@stop

@section('js')
	<script type="text/javascript" >
		var message;
		<?php if(old("message")){ ?>
			message = <?php echo '"'.old("message").'"'; ?>;
		<?php } ?>

		
		
	</script>
	<script type="text/javascript" src="{{ asset('/js/mypage.js') }}"></script>
@stop
