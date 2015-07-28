@extends('full')

@section('title')
無料会員登録 | A+plus
@stop

@section('main_content')

<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default">
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
				<input type="hidden" name="social_id" value="{{ old('social_id') }}">
				

				<div class="form-group">
					<label for="file_input">プロフィール画像</label>
					<table class="table table-bordered" style="border: none !important;">
						<tr><td rowspan="2" style="border: none !important;">
							<img class="thumbnail_avatar" src="{{ old('avatar_url')? old('avatar_url'):'/image/dummy.png'}}" width="100" height="100" alt="dummy_image">
							</td>
							<td class="upload_content"style="border: none !important;">
								<input type="hidden" name="avatar_url" value="{{ old('avatar_url') }}">
								<input id="file_input" type="file" name="avatar" class="form-element" style="display:none;">
							</td>
						</tr>
						<tr>
							<td style="border: none !important;">
								<button type="button" id="sns_button" class="btn btn-default">SNSからの画像を利用する</button>
								<button type="button" id="photo_button" class="btn btn-default">写真をアップロードする</button>
								<button type="button" id="reset_avatar_button" class="btn btn-default">デフォルト画像を利用する</button>
								
							</td>
						</tr>
					</table>
				</div>

				<div class="panel panel-danger" style="margin-bottom: 15px;">
					<div class="panel-title">
					画像の大きさは100×100px以内、画像ファイルはjpg,png,gifのみで、大きさは1.5MBまでです。<br>画像が大きい場合は縮小拡大されます。
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
					<select name="entrance_year" class="form-element" value="{{ old('entrance_year') }}">
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
				<div class="form-group">
					<label>学部</label>
					<select name="faculty" class="form-element" value="{{ old('faculty') }}">
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
				<div class="form-group">
					<label>性別</label>
					<div class="radio-btn">
						<label>
						<input type="radio" name="sex" value="男性" checked>
						男性
						</label>
					</div>
					<div class="radio-btn">
						<label>
						<input type="radio" name="sex" value="女性">
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
							登録の前に、必ず<a href="/term">「利用規約および個人情報の利用に関するポリシー」</a>をご覧ください。<br />
							全項目において同意できた方のみ登録ボタンをクリックしてください。
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">
						登録
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	var message = <?php echo "'".old("message")."'"; ?>;
	var avatar_url = <?php echo "'".old("avatar_url")."'"; ?>;
</script>
<script type="text/javascript" src="{{ asset('js/socialregister.js') }}"></script>
@endsection
