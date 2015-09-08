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
		{{ $data['res_string'] }}
		{{ $data['classes']->total()? $data['classes']->total()."件ヒットしました！":"" }}
	</div>
</div>
<form class="search_form" action="/search" method="get">
	<table class="table table-bordered">
	<tr>
		<th>キーワード</th>
		<td width="75%" >
			<div class="form-element-group">
				<input class="form-element" type="text" size="20" placeholder="授業名・教師名・キーワードで検索！" name="q" value="{{{ $data['get']['q']? $data['get']['q']:"" }}}" />
				<span class="form-group-btn">
					<button class="btn btn-primary" id="search_button" type="submit">検索</button>
				</span>
			</div>
		</td>
	</tr>
	<tr>
		<th>学部</th>
		<td>
			<select name="faculty">
				<option value="" >指定なし</option>
				<option value="人間科学部" {{ $data['get']['faculty'] == '人間科学部'? 'selected':'' }}>人間科学部</option>
				<option value="スポーツ科学部" {{ $data['get']['faculty'] == 'スポーツ科学部'? 'selected':'' }}>スポーツ科学部</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>曜日</th>
		<td>
			<select name="day">
				<option value="">指定なし</option>
				<option value="月" {{ $data['get']['day'] == '月'? "selected":"" }}>月</option>
				<option value="火" {{ $data['get']['day'] == '火'? "selected":"" }}>火</option>
				<option value="水" {{ $data['get']['day'] == '水'? "selected":"" }}>水</option>
				<option value="木" {{ $data['get']['day'] == '木'? "selected":"" }}>木</option>
				<option value="金" {{ $data['get']['day'] == '金'? "selected":"" }}>金</option>
				<option value="土" {{ $data['get']['day'] == '土'? "selected":"" }}>土</option>
				<option value="無その他" {{ $data['get']['day'] == '無その他'? "selected":"" }}>無その他</option>
				<option value="無フルOD" {{ $data['get']['day'] == '無フルOD'? "selected":"" }}>無フルOD</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>時限</th>
		<td>
			<select name="period">
				<option value="">指定なし</option>
				<option value="1" {{ $data['get']['period'] == '1'? "selected":"" }}>1限</option>
				<option value="2" {{ $data['get']['period'] == '2'? "selected":"" }}>2限</option>
				<option value="3" {{ $data['get']['period'] == '3'? "selected":"" }}>3限</option>
				<option value="4" {{ $data['get']['period'] == '4'? "selected":"" }}>4限</option>
				<option value="5" {{ $data['get']['period'] == '5'? "selected":"" }}>5限</option>
				<option value="6" {{ $data['get']['period'] == '6'? "selected":"" }}>6限</option>
				<option value="7" {{ $data['get']['period'] == '7'? "selected":"" }}>7限</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>学期</th>
		<td>
			<select name="term">
				<option value="" >指定なし</option>
				<option value="0"  {{{ $data['get']['term'] === '0'? " selected":"" }}}>春学期</option>
				<option value="1"  {{{ $data['get']['term'] === '1'? " selected":"" }}}>秋学期</option>
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
	<div class="row-fluid">
		<div class="col12">
			<div class="pagination text-center" style="0 auto;">
				<?php echo $data['classes']->render(); ?>
			</div>
		</div>
	</div>
@stop

