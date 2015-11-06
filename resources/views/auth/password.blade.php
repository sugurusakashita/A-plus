@extends('full')

@section('title')
パスワードのリセット | A+plus
@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

@section('main_content')
<div class="panel panel-info">
	<div class="panel-title">
		パスワードのリセット
	</div>
	<div class="panel-body">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				入力に誤りがあります。<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li style="color:red;">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<label class="col4">メールアドレス</label>
				<div class="col6">
					<input type="email" class="form-element" name="email" value="{{ old('email') }}">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						パスワード変更メールを送る
					</button>
				</div>
			</div>
		</form>
		<div class="panel panel-warning">
			<div class="panel-title">
				■メールが届かない場合
			</div>
			<div class="panel-body">
				<ul>
					<li>フリーメールアドレスをご利用の方は、ゴミ箱や迷惑メールフィルタに振り分けられていないか確認してください。</li>
					<li>メールのセキュリティレベルが「高」「強」となっている場合はレベルを下げて、再送信してください。</li>
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection
