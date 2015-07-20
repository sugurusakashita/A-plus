@extends('full')

@section('title')
A+plus
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
  <div class="container">
  	<div class="change_password_form">
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/mypage/change-password-complete') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label class="control-label">現在のパスワード</label>
				<div class="col-md-6">
					<input type="password" class="form-control" name="old_password">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label">新しいパスワード</label>
				<div class="col-md-6">
					<input type="password" class="form-control" name="password">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label">新しいパスワード(確認)</label>
				<div class="col-md-6">
					<input type="password" class="form-control" name="password_confirmation">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						パスワードを変更する
					</button>
				</div>
			</div>
		</form>
  	</div>
  </div>
@stop
@section('js')
	
@stop