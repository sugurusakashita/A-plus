@extends('master')

@section('sidebar')
	@include('common.sidebar')
@stop

@section('title')
	タグ追加 | {{ $detail->class_name }} | A+plus
@stop

@section('main_content')
	<div class ="row">
		<!-- タイトル -->
		<div class="alert a-is-info" style="margin: 0 auto 5px;">
		 <p>「{{ $detail->class_name }}」にタグを追加する</p>
		</div>
		<div class="alert a-is-warning section-margin" >
			@foreach($tag_names as $t)
				<form action ="/classes/index/{{ $detail->class_id }}" method="POST" name="add_tag" class="add-tag-form">
					<button class="btn btn-primary" type="submit">{{ $t->tag_name }}</button>
					<input type="hidden" value="{{ $t->tag_name }}" name="add_tag_name">
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
				</form>
			@endforeach
		</div>
	</div>
	<div class ="row section-margin">
		<a href="/classes/index/{{ $detail->class_id }}" class="btn btn-default back">戻る</a>
	</div>
@stop