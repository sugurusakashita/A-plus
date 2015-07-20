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
  <p>パスワードの変更が完了しました。</p>
  </div>
@stop
@section('js')
	
@stop