@extends('full')

@section('title')
マイページ | A+plus
@stop

@section('css')

@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

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
	<div class="panel panel-success">
		<div class="panel-title">マイページ</div>
		<div class="panel-body">プロフィールを変更するには「編集」ボタンをクリックしてください。
			<div class="section-margin row-fluid">
				<div class="col3">
					<div class="panel panel-info">
						<div class="panel-title">プロフィール画像</div>
						<div class="panel-body">
							<img class="profile-value" width="100" height="100" src="{{ $data['user']->avatar? $data['user']->avatar:asset('image/dummy.png') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<a class="btn btn-sm btn-success btn-xs right-float" href="/mypage/avatar">編集</a>
						</div>
					</div>
				</div>
				<div class="col9">
					<div class="panel panel-info">
						<div class="panel-title">ユーザー名</div>
						<div class="panel-body">
							<form class="name" action='#' method='POST'>
								<span class="profile-value">{{ $data['user']->name }}</span>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid section-margin">
				<div class="col7">
					<div class="panel panel-warning">
						<div class="panel-title">登録メールアドレス</div>
						<div class="panel-body">
							<form class="email" action='#' method='POST'>
							<span class="profile-value">{{ $data['user']->email }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col5">
					<div class="panel panel-warning">
						<div class="panel-title">パスワード</div>
						<div class="panel-body">
							<span class="profile-value">**********</span>
						</div>
					</div>
				</div>
			</div>
			<div class="section-margin row-fluid">
				<div class="col4">
					<div class="panel panel-default">
						<div class="panel-title">性別</div>
						<div class="panel-body">
							<form class="sex" action='#' method='POST'>
							<span class="profile-value">{{ $data['user']->sex }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col4">
					<div class="panel panel-default">
						<div class="panel-title">入学年度</div>
						<div class="panel-body">
							<form class="entrance_year" action='#' method='POST'>
							<span class="profile-value">{{ $data['user']->entrance_year }}{{ $data['user']->entrance_year == "その他"? "":"年度"  }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col4">
					<div class="panel panel-default">
						<div class="panel-title">学部</div>
						<div class="panel-body">
							<form class="faculty" action='#' method='POST'>
							<span class="profile-value">{{ $data['user']->faculty }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div id="password-notice" class="panel-body">
					パスワードの変更は、お手数ですが一度パスワードをリセットしてから再設定となります。<br />
					<a href="/password/email">こちらから登録されているアドレスにメールを送信して再設定してください。</a>
				</div>
			</div>
		</div>
	</div>
	<!-- campaign start -->
      <div class="panel panel-danger section-margin" id="campaign2">
        <div class="panel-title">
          会員登録・レビューでAmazonギフト券1000円分キャンペーン　第２弾 参加状況
        </div>
        <div class="panel-body">
        	<div class="row-fluid">
        		<div class="col7">
			          <p>{{ Auth::user()->name }}さんのキャンペーン参加状況:<b>{{ $data['camp2']['isEntry']? "エントリー済み！":"条件未達成" }}</b></p><br>
			          <ul>
			            <li><b>STEP1: <span style="color:red;">OK!!</span></b></li>
			            <li><b>STEP2: <span style="color:red;">{{  $data['camp2']['step2']? 'OK!!': 'NG...' }}</span></b></li>
			            <li><b>STEP3: <span style="color:red;">{{  $data['camp2']['step3']? 'OK!!': 'NG...(あと'.$data['diffReview'].'件のレビューでクリア！)' }}</span></b></li>
			          </ul>
        		</div>
        		<div class="col5"><img src="/image/campaign/event2-lg.png" alt="第二弾キャンペーン" style="width:86%;"></div>
        	</div>

        </div>
      </div>
	<!-- campaign end -->
	<div class="panel panel-primary section-margin">
		<div class="panel-title">
			<div class="row-fluid">
				<div class="col9">レビュー履歴</div>
				<div class="col3">合計レビュー件数: <span style="color:#F35D5D;">{{ $data['reviews']->count() }}件</span></div>
			</div>
		</div>
		<div class="panel-body">
			@if(!$data['reviews']->count())
				<p style='color:#FF0000;'>まだレビューされていません。</p>
			@else
			@foreach($data['reviews'] as $review)
			<div class="panel panel-default">
				<div class="panel-title">
					<div class="row-fluid">
						<div class="col9" style='font-size:1.3em'>
							<a href="/classes/index/{{ $review->classes()->first()->class_id }}">{{ $review->classes()->first()->class_name }}</a>
							<form action="/mypage/edit" method="get" class="review-edit-delete">
									<input type="hidden" value="{{{ $review->review_id }}}" name="review_id">
									<input type="hidden" name="_token" value="{{csrf_token()}}" />
									<button type="submit" class="btn btn-success btn-sm" >編集</button>
						        </form>
						        <form action="/mypage/delete-confirm" method="POST" class="review-edit-delete">
						          	<input type="hidden" value="{{{ $review->review_id }}}" name="review_id">
						          	<input type="hidden" name="_token" value="{{csrf_token()}}" />
						          	<button type="submit" class="btn btn-danger btn-sm">削除</button>
						         </form>
						</div>
						<div class="col3">
							更新日時:{{ $review->updated_at }}

						</div>
					</div>
				</div>
				<div class="panel-title">
					<div class="row-fluid">
						<div class="col3">
						総合<span class="raty_stars" data-star="{{ $review->stars }}"></span>
						</div>
						<div class="col3">
						単位の取りやすさ<span class="raty_stars" data-star="{{ $review->unit_stars }}"></span>
						</div>
						<div class="col3">
						GP(成績)の取りやすさ<span class="raty_stars" data-star="{{ $review->grade_stars }}"></span>
						</div>
						<div class="col3">
						内容の充実度<span class="raty_stars" data-star="{{ $review->fulfill_stars }}"></span>
						</div>
					</div>
				</div>
				<div class="panel-body">
					{{ mb_strimwidth($review->review_comment,0,100,"...") }}
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" >
		var message;
		<?php if(old("message")){ ?>
			message = <?php echo '"'.old("message").'"'; ?>;
		<?php } ?>

	</script>
	<script type="text/javascript" src="{{ asset('/js/mypage.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
@stop
