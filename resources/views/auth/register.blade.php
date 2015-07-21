@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">A+plus | 無料会員登録</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="control-label col-md-4">
								<label  >プロフィール画像(公開・任意)</label>
							</div>
							<div class="col-md-6">
								<img class="thumbnail_photo" src="{{ asset('image/dummy.png')}}" width="100" height="100" alt="dummy_image">
								<input type="file" name="photo" value="{{ old('photo') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">ユーザーネーム(公開・必須)</label>
							<div class="col-md-6">
								
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">メールアドレス(非公開・必須)</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>
						<!-- 追加 -->
						<div class="form-group">
							<label class="col-md-4 control-label">入学年度(公開・任意)</label>
							<div class="col-md-6">
								<select name="entrance_year" class="form-control" value="{{ old('entrance_year') }}">
									<option value="">選択してください</option>
									<option value="その他">2010年度以前</option>
									<option value="2010">2010年度(修士:2年生/学部:6年生)</option>
									<option value="2011">2011年度(修士:1年生/学部:5年生)</option>
									<option value="2012">2012年度(学部:4年生)</option>
									<option value="2013">2013年度(学部:3年生)</option>
									<option value="2014">2014年度(学部:2年生)</option>
									<option value="2015">2015年度(学部:1年生)</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">学部(公開・任意)</label>
							<div class="col-md-6">
								<select name="faculty" class="form-control" value="{{ old('faculty') }}">
									<option value="">選択してください</option>
									<optgroup label="--------学部--------">
										<option value="人間科学部">人間科学部</option>
										<option value="スポーツ科学部">スポーツ科学部</option>
									</optgroup>
									<optgroup label="-------大学院-------">
										<option value="人間科学研究科">人間科学研究科</option>
										<option value="スポーツ科学研究科">スポーツ科学研究科</option>
									</optgroup>
								</select>
							</div>
						</div>　
						<div class="form-group">
							<label class="col-md-4 control-label">性別(公開・任意)</label>
							<div class="col-md-6">
								<div class="col-md-6">
									<input type="radio" name="sex" value="男性">
									<p>男性</p>									
								</div>
								<div class="col-md-6">
									<input type="radio" name="sex" value="女性">
									<p>女性</p>									
								</div>
							</div>
						</div>
						<!-- ここまで -->
						<div class="form-group">
							<label class="col-md-4 control-label">パスワード(非公開・必須)</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">パスワード確認(必須)</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						<div class="read-policy" style="text-align:center;">
							<p>登録の前に、必ず<a href="/term">「利用規約および個人情報の利用に関するポリシー」</a>をご覧ください。</p>
							<p>全項目において同意できた方のみ登録ボタンをクリックしてください。</p>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									登録
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
