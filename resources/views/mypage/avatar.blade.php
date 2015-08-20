@extends('full')

@section('title')
プロフィール画像変更 | A+plus
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
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/mypage/avatar-complete') }}" enctype='multipart/form-data'>
			<div class="form-group">
				<div class="control-label col-md-4">
					<label>現在のプロフィール画像</label>
					<img src="{{ $data['user']->avatar? $data['user']->avatar:asset('image/dummy.png') }}" width="100" height="100" alt="user_image">
				</div>
				<div class="col-md-6">
				<label>新しいプロフィール画像</label>
					<img class="thumbnail_avatar" src='{{ asset("image/dummy.png") }}' width="100" height="100" alt="dummy_image">
					<input id = "file_input" type="file" name="avatar" accept="image/*">
					<button type="button" id="reset_avatar">画像をリセットする</button>
					<p class="warning" style="color:red">画像の大きさは100×100px、画像ファイルはjpg,png,gifのみで、大きさは2MBまでです。<br>画像が大きい場合は縮小拡大されます。</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						登録
					</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
  	</div>
  </div>
@stop
@section('js')
	<script type="text/javascript" src="{{ asset('js/avatar.js') }}"></script>
@stop