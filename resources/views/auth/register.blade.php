@extends('full')

@section('title')
無料会員登録 | A+plus
@stop


@section('main_content')
<div>
<div class="panel panel-info section-margin">
	<div class="panel-title">
		SNSアカウントで新規登録
	</div>
	<div class="panel-body">
		<div class="col12 section-margin">
			<div class="col6 text-center">
				<a href="/auth/twitter-oauth">
					<button type="button" class="btn btn-lg btn-info twitter-regi-button">
						<span class="icon-twitter2 icons"></span>Twitterで新規登録
					</button>
				</a>
			</div>
			<div class="col6 text-center">
				<a href="/auth/facebook-oauth">
					<button type="button" class="btn btn-lg btn-info facebook-regi-button">
						<span class="icon-facebook2 icons"></span>Facebookで新規登録
					</button>
				</a>
			</div>
		</div>
		<div class="text-center ">
			<p style="color:red">※無断でSNSにシェアやツイートなど発信することは一切ございません。</p>
		</div>
	</div>
</div>
	<br />
	<div class="panel panel-default">
		<div class="panel-title">
			メールアドレスで登録
		</div>
		<div class="panel-body">
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

			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" enctype='multipart/form-data'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label for="file_input">プロフィール画像</label>
					<table class="table table-bordered" style="border: none !important;">
						<tr><td rowspan="2" style="border: none !important;">
							<img class="thumbnail_avatar" src="/image/dummy.png" width="100" height="100" alt="dummy_image">
							</td>
							<td style="border: none !important;"><input id="file_input" type="file" name="avatar" class="form-element" accept="image/*"></td>
						</tr>
						<tr><td style="border: none !important;"><button type="button" id="reset_avatar" class="btn btn-default">画像をリセットする</button></td></tr>
					</table>
				</div>

				<div class="panel panel-danger" style="margin-bottom: 15px;">
					<div class="panel-title">
					画像の大きさは100×100px、画像ファイルはjpg,png,gifのみで、大きさは2MBまでです。<br>
					画像が大きい場合は縮小拡大されます。
					</div>
				</div>

				<div class="form-group">
					<label>ユーザーネーム</label>
					<input type="text" class="form-element" name="name" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label>メールアドレス</label>
					<input type="email" class="form-element" name="email" value="{{ old('email') }}">
				</div>
				<!-- 追加 -->
				<div class="form-group">
					<label>入学年度</label>
					<select name="entrance_year" class="form-element">
						<option value="">選択してください</option>
						<option value="その他" {{old('entrance_year') === "その他"? "selected":""}}>2011年度以前</option>
						<option value="2012" {{old('entrance_year') === "2012"? "selected":""}}>2012年度(4年生)</option>
						<option value="2013" {{old('entrance_year') === "2013"? "selected":""}}>2013年度(3年生)</option>
						<option value="2014" {{old('entrance_year') === "2014"? "selected":""}}>2014年度(2年生)</option>
						<option value="2015" {{old('entrance_year') === "2015"? "selected":""}}>2015年度(1年生)</option>
					</select>
				</div>
				<div class="form-group">
					<label>学部</label>
					<select name="faculty" class="form-element">
						<option value="">選択してください</option>
						<optgroup label="--------学部--------">
							<option value="人間科学部" 	 {{ old('faculty') === "人間科学部"? "selected":"" }}>人間科学部</option>
							<option value="スポーツ科学部" {{ old('faculty') === "スポーツ科学部"? "selected":"" }}>スポーツ科学部</option>
						</optgroup>
<!-- 						<optgroup label="-------大学院-------">
							<option value="人間科学研究科">人間科学研究科</option>
							<option value="スポーツ科学研究科">スポーツ科学研究科</option>
						</optgroup> -->
					</select>
				</div>　
				<div class="form-group">
					<label>性別</label>
					<div class="radio-btn">
						<label>
						<input type="radio" name="sex" value="男性" {{ old('sex') === "男性"? "checked":"" }}>
						男性
						</label>
					</div>
					<div class="radio-btn">
						<label>
						<input type="radio" name="sex" value="女性" {{ old('sex') === "女性"? "checked":"" }}>
						女性
						</label>
					</div>
				</div>
				<div class="form-group">
					<label>パスワード</label>
					<input type="password" class="form-element" name="password">
				</div>
				<div class="form-group">
					<label>パスワード確認</label>
					<input type="password" class="form-element" name="password_confirmation">
				</div>
				<div class="form-group">
					<div class="panel panel-danger">
						<div class="panel-body">
							登録の前に、必ず<a href="/term" target="_blank">利用規約</a>をご覧ください。<br />
							登録ボタンをクリックした場合、利用規約の全項目に同意したこととみなします。
						</div>
					</div>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-lg btn-primary">
						新規登録
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/register.js') }}"></script>
@endsection
