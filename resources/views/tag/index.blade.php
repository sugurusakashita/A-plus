@extends('master')

@section('sidebar')
@include('common.sidebar')
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

		<h2>タグ一覧</h2>
<!--
	@foreach($data['tag_names'] as $t)
		<a href="">{{ $t->tag_name }}</a><?php echo "　"?>
	@endforeach
-->
	@foreach($data['tag_names'] as $t)
		<form action ="/classes/index/{{ $data['detail']->class_id }}" method="POST" name="add_tag">
				<button type="submit">追加する</button>
				<p>{{ $t->tag_name }}</p>
				<input type="hidden" value="{{ $t->tag_name }}" name="add_tag_name">
				<input type="hidden" name="_token" value="{{csrf_token()}}" />
				<hr>
		</form>
	@endforeach
		<!-- 
		<table class="table table-striped table-hover">
			<tbody>
				<tr>
				@foreach($data['tag_names'] as $t)
					<td width="224">{{ $t }}</td>
				@endforeach
				</tr>
			</tbody>
		</table>
		-->
	</div>
@stop