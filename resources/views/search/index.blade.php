@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
「{{ $data['get']['q'] }}」検索結果 | A+plus
@stop

@section('main_content')

<div class="panel panel-warning" style="margin-bottom: 15px;">
	<div class="panel-title">
		{{ $data['get']['term'] == 2? "":$data['term'][$data['get']['term']] }}
				@if($data['get']['day'])
					{{ $data['get']['day']}}
					@if($data['get']['day'] != "夏季")
						{{ "曜日 " }}
					@endif
				@endif
			{{ $data['get']['period']? $data['get']['period']."限 ":"" }}
			{{ '「'.$data['get']['q'].'」の検索結果' }}

		{{ $data['classes']->total()? $data['classes']->total()."件ヒットしました！":"" }}
	</div>
</div>
<form class="search_form" action="/search" method="get">
	<table class="table table-bordered">
	<tr>
		<th>キーワード</th>
		<td width="75%">
		<div class="form-element-group">
		<input class="form-element" type="text" size="20" placeholder="授業名・教師名・キーワードで検索！" name="q" value="{{{ $data['get']['q']? $data['get']['q']:"" }}}" />
		<span class="form-group-btn">
		<button class="btn btn-primary" id="search_button" type="submit">検索</button>
		</span>
		</div>
		</td>
	</tr>
	<tr>
		<th>曜日</th>
		<td>
		<select name="day">
		<option value="0">指定なし</option>
		<?php
		$days = ["指定なし","月","火","水","木","金","土","無その他"];
		for($i = 1;$i < 8;$i++){

		$str =  "<option value=\"".$days[$i];
		$str .= $data['get']['day'] == $days[$i]? "\" selected >":"\" >";
		$str .= $days[$i]."</option>";
		echo $str;
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<th>時限</th>
		<td>
		<select name="period">
		<option value="0">指定なし</option>
		<?php
		for($i = 1;$i < 8;$i++){
		$str =  "<option value=\"".$i;
		$str .= $data['get']['period'] == $i? "\" selected >":"\" >";
		$str .= $i."限</option>";
		echo $str;
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<th>学期</th>
		<td>
		<select name="term">
		<option value="2"  {{{ $data['get']['term'] == 2? "selected":"" }}}>指定なし</option>
		<option value="0"  {{{ $data['get']['term'] == 0? " selected":"" }}}>春学期</option>
		<option value="1"  {{{ $data['get']['term'] == 1? " selected":"" }}}>秋学期</option>
		</select>
		</td>
	</tr>
	</table>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
@if($data['classes']->count())
	@foreach ($data['classes'] as $class_data)
	<?php
		// 各授業のreview数とタグを取得
		$class_id = $class_data->class_id;
		$review_count = $data['review']->where("class_id","=",$class_id)->get()->count();
		$tags = $data['tag']->where("class_id","=",$class_id)->get();
	?>

	<div style="margin-bottom: 15px;">
			<ul class="list-group">
			  <li class="list-group-element">
			  	<span class="badge info">{{ $class_data->class_week }}</span>
			  	　<span class="badge warning"><?php echo $class_data->class_period === "00"? "その他":$class_data->class_period."限"; ?></span>
			  	@if($review_count)
			  		<span class="badge danger right-float">レビュー件数:  {{ $review_count }}件</span>
		  		@endif
			  </li>
			  <li class="list-group-element">
			  	<a href="/classes/index/{{ $class_data->class_id }}">{{ $class_data->class_name }}</a>
			  </li>
	  		@if(!(count($tags) == 0))
			  <li class="list-group-element">
	  			@foreach($tags as $tag)
			  		<span class="btn-label info">
			  			{{ $tag->tag_name }}
			  		</span>
	  			@endforeach
			  </li>
	  		@endif

			  @if($class_data->teachers()->get()->count())
			  <li class="list-group-element">
			  	@foreach($class_data->teachers()->get() as $teacher)
			 		<a href="/search?q={{ urldecode($teacher->teacher_name) }}&day=0&period=0&term=2&_token={{csrf_token()}}">{{ $teacher->teacher_name }}</a>
			 	@endforeach
			  </li>
			  @endif

			  @if($class_data->summary)
			  <?php
			  	//要約作成
			  	$summary = mb_strimwidth($class_data->summary,0,150,"...");
			  ?>
			  <li class="list-group-element">
			  	<p>{{ $summary }}</p>
			  </li>
			  @endif
			</ul>
	</div>

	@endforeach
@else
	<div class="alert a-is-danger alert-removed fade in">
		検索結果が存在しませんでした。再検索してください。
	</div>
@endif

	<div class="pagination" style="margin: 20px auto; height: 40px;">
		<?php echo $data['classes']->render(); ?>
	</div>
@stop

