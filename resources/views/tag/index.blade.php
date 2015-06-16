@extends('master')

@section('sidebar')
<div class="sidebar">
	<div class="access_ranking">
		<span><h3>アクセスランキング</h3></span>
		<hr>
		<span>
		<?php
			$i = 1;
			foreach ($data['access_ranking'] as $ranking) {
				echo "<p>第 ".$i." 位　".$ranking->class_name."</p>";
				$i++;
			}
		?>
		</span>
	</div>
	<div class="search_word_ranking">
		<span><h3>人気検索ワードランキング</h3></span>
		<hr>
		<span>
		<?php
			$i = 1;
			foreach ($data['search_ranking'] as $ranking) {

				echo "<p>第 ".$i." 位　".$ranking->word."</p>";
				$i++;
			}
		?>
		</span>
	</div>
</div>
@stop

@section('title')
タグ追加 | {{ $data['detail']->class_name }}
@stop

@section('main_content')
	<div class ="row">
		<h1>{{ $data['detail']->class_name }}にタグを追加する</h1>
		<hr>
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