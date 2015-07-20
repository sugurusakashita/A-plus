@extends('master')

@section('sidebar')
	@include('common.sidebar')
@stop

@section('css')
<style>
	form{
		width: 33%;
		margin: 10px 0 !important;
		float: left;
	}
	button.back{
		margin: 15px 0;
	}
</style>
@stop

@section('title')
	タグ追加 | {{ $data['detail']->class_name }}
@stop

@section('main_content')
	<div class ="row">

	<!-- タイトル -->
	<div class="alert a-is-info" style="margin: 0 auto 5px;">
	 <p>「{{ $data['detail']->class_name }}」にタグを追加する</p>
	</div>

	@foreach($data['tag_names'] as $t)
		<form action ="/classes/index/{{ $data['detail']->class_id }}" method="POST" name="add_tag">
			<button class="btn btn-default" type="submit">{{ $t->tag_name }}</button>
			<input type="hidden" value="{{ $t->tag_name }}" name="add_tag_name">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
		</form>
	@endforeach

	<a href="{{ $_SERVER['HTTP_REFERER'] }}"><button class="btn btn-default back">戻る</button></a>
	</div>
@stop