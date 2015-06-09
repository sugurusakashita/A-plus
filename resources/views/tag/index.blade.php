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
タグ検索 | {{ $data['detail']['class_name'] }}
@stop

@section('main_content')
	<div class ="row">
		@foreach($data['tag'] as $t)
			<p>{{ $t[0]->tag_name }}</p>
		@endforeach

	</div>
@stop