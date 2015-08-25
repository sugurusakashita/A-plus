@extends('full')

@section('title')
ログイン | A+plus
@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

@section('main_content')
			@if (count($errors) > 0)
				<div class="panel panel-danger">
					<div class="panel-title">
						入力の一部に誤りがあります。<br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
<div class="panel panel-info section-margin">
	<div class="panel-title">
		SNSアカウントでログイン
	</div>
	<div class="panel-body">
		<div class="col12 section-margin">
			<div class="col6 text-center">
				<a href="/auth/twitter-oauth">
					<button type="button" class="btn btn-lg btn-info twitter-regi-button">
						<span class="icon-twitter2 icons"></span>Twitterでログイン
					</button>
				</a>
			</div>
			<div class="col6 text-center">
				<a href="/auth/facebook-oauth">
					<button type="button" class="btn btn-lg btn-info facebook-regi-button">
						<span class="icon-facebook2 icons"></span>Facebookでログイン
					</button>
				</a>
			</div>
		</div>
		<div class="text-center ">
			<p style="color:red">※無断でSNSにシェアやツイートなど発信することは一切ございません。</p>
			<p>ログインボタンをクリックした場合、<a href="/term">利用規約</a>に同意したこととみなします。</p>
			<p>新規登録は<a href="/auth/register">こちら</a>のページから行ってください。</p>
		</div>
	</div>
</div>
	<div class="panel panel-default">
		<div class="panel-title">
			メールアドレスでログイン
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="emailID">メールアドレス</label>
					<input type="email" id="emailID" class="form-element" name="email" value="{{ old('email') }}">
				</div>

				<div class="form-group">
					<label for="passwordID">パスワード</label>
					<input type="password" id="passwordID" class="form-element" name="password">
				</div>

				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> 次回からパスワードを記憶する
						</label>
					</div>
				</div>

				<div class="form-group text-center">
					<button type="submit" class="btn btn-lg btn-primary">ログイン</button>
					<p>ログインボタンをクリックした場合、<a href="/term">利用規約</a>に同意したこととみなします。</p>
					<a class="btn btn-link" href="{{ url('/password/email') }}">パスワードを忘れましたか？</a>
				</div>

			</form>
		</div>
	</div>
@endsection
