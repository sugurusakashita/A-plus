@extends('full')

@section('title')
ログイン | A+plus
@stop

@section('main_content')
<div class="col12">
	<div class="panel panel-default">
		<div class="panel-body">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					入力の一部に誤りがあります。<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label for="emailID">E-Mail Address</label>
					<input type="email" id="emailID" class="form-element" name="email" value="{{ old('email') }}">
				</div>

				<div class="form-group">
					<label for="passwordID">Password</label>
					<input type="password" id="passwordID" class="form-element" name="password">
				</div>

				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember Me
						</label>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Login</button>
					<a class="btn btn-link" href="{{ url('/password/email') }}">パスワードを忘れましたか？</a>
				</div>
				<div class="form-group">
					<a href="/auth/twitter-oauth">Twitterでログイン</a>
					<a href="/auth/facebook-oauth">Facebookでログイン</a>	
				</div>

			</form>
		</div>
	</div>
</div>
@endsection
