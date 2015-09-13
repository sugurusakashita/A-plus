@extends('full')

@section('title')
パスワードの変更 | A+plus
@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

@section('main_content')
<div class="panel panel-default">
	<div class="panel-title">パスワードの変更</div>
	<div class="panel-body">
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

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="token" value="{{ $token }}">

			<div class="form-group">
				<label class="col4">メールアドレス</label>
				<div class="col6">
					<input type="email" class="form-element" name="email" value="{{ old('email') }}">
				</div>
			</div>

			<div class="form-group">
				<label class="col4">新しいパスワード</label>
				<div class="col6">
					<input type="password" class="form-element" name="password">
				</div>
			</div>

			<div class="form-group">
				<label class="col4">パスワード確認</label>
				<div class="col6">
					<input type="password" class="form-element" name="password_confirmation">
				</div>
			</div>

			<div class="form-group">
				<div class="col6 offset4">
					<button type="submit" class="btn btn-primary">
						パスワードを変更する
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
