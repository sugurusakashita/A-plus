@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
「{{ $get['q'] }}」検索結果 | A+plus
@stop

@section('main_content')

<div class="panel panel-warning" style="margin-bottom: 15px;">
	<div class="panel-title">
		{{ $res_string }}
		{{ $classes->total()? $classes->total()."件ヒットしました！":"" }}
	</div>
</div>
<form class="search_form" action="/search" method="get">
	<table class="table table-bordered">
	<tr>
		<th>キーワード</th>
		<td width="75%" >
			<div class="form-element-group">
				<input class="form-element" type="text" size="20" placeholder="授業名・教師名・キーワードで検索！" name="q" value="{{ $get['q'] ?:"" }}" />
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
				<option value="人間科学部" {{ $get['faculty'] == '人間科学部'? 'selected':'' }}>人間科学部</option>
				<option value="スポーツ科学部" {{ $get['faculty'] == 'スポーツ科学部'? 'selected':'' }}>スポーツ科学部</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>曜日</th>
		<td>
			<select name="day">
				<option value="">指定なし</option>
				<option value="月" {{ $get['day'] == '月'? "selected":"" }}>月</option>
				<option value="火" {{ $get['day'] == '火'? "selected":"" }}>火</option>
				<option value="水" {{ $get['day'] == '水'? "selected":"" }}>水</option>
				<option value="木" {{ $get['day'] == '木'? "selected":"" }}>木</option>
				<option value="金" {{ $get['day'] == '金'? "selected":"" }}>金</option>
				<option value="土" {{ $get['day'] == '土'? "selected":"" }}>土</option>
				<option value="無その他" {{ $get['day'] == '無その他'? "selected":"" }}>無その他</option>
				<option value="無フルOD" {{ $get['day'] == '無フルOD'? "selected":"" }}>無フルOD</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>時限</th>
		<td>
			<select name="period">
				<option value="">指定なし</option>
				<option value="1" {{ $get['period'] == '1'? "selected":"" }}>1限</option>
				<option value="2" {{ $get['period'] == '2'? "selected":"" }}>2限</option>
				<option value="3" {{ $get['period'] == '3'? "selected":"" }}>3限</option>
				<option value="4" {{ $get['period'] == '4'? "selected":"" }}>4限</option>
				<option value="5" {{ $get['period'] == '5'? "selected":"" }}>5限</option>
				<option value="6" {{ $get['period'] == '6'? "selected":"" }}>6限</option>
				<option value="7" {{ $get['period'] == '7'? "selected":"" }}>7限</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>学期</th>
		<td>
			<select name="term">
				<option value="" >指定なし</option>
				<option value="春学期"  {{ $get['term'] === '春学期'? " selected":"" }}>春学期・夏季集中</option>
				<option value="秋学期"  {{ $get['term'] === '秋学期'? " selected":"" }}>秋学期・冬季集中</option>
				<option value="通年"  {{ $get['term'] === '通年'? " selected":"" }}>通年</option>
			</select>
		</td>
	</tr>
	</table>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
@if($classes->count())
	@foreach ($classes as $class_data)
	<?php
		// 各授業のreview数とタグを取得
		$reviewCount = $review->reviewCountByClassId($class_data->class_id);
		$tags = $tag->tagsByClassId($class_data->class_id);

	?>

	<div style="margin-bottom: 15px;">
		<ul class="list-group">
		  	<li class="list-group-element">
		  		<span class="badge primary">{{ $class_data->faculty }}</span>
		  	　	<span class="badge success">{{ $class_data->term }}</span>
		  		@foreach($class_data->classes_detail()->get() as $classDetail)
				<span class="badge info">{{ $classDetail->class_week }}</span>
		 		<span class="badge warning"><?php echo $classDetail->class_period === "00"? "その他":$classDetail->class_period."限"; ?></span>
		  		@endforeach
		  		@if($reviewCount)
		  		<span class="badge danger">レビュー件数:  {{ $reviewCount }}件</span>
	  			@endif
		 	</li>
		  	<li class="list-group-element">
		  		<a href="/classes/index/{{ $class_data->class_id }}">{{ $class_data->class_name }}</a>
		  	</li>
		  	@if($class_data->teachers()->get()->count())
		  	<li class="list-group-element">
		  	@foreach($class_data->teachers()->get() as $teacher)
		  		<form action="/search/" method="get" style="display:inline;">
            		<input type="hidden" name="_token" value="{{csrf_token()}}">
            		<input type="hidden" name="q" value="{{ $teacher->teacher_name }}">
            		<button class="btn btn-danger-outline btn-sm">{{ $teacher->teacher_name }}</button>
		  		</form>
		 	@endforeach
		  	</li>
			@if(count($tags) != 0)
		  	<li class="list-group-element">
				@foreach($tags as $tag)
		  		<span class="btn-label info">
		  			{{ $tag->tag_name }}
		  		</span>
				@endforeach
		  	</li>
			@endif
		  	@endif
		  	@if($class_data->summary)
		  	<li class="list-group-element">
		  		<p>{{ mb_strimwidth($class_data->summary,0,150,"...") }}</p>
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
				<?php echo $classes->render(); ?>
			</div>
		</div>
	</div>
@stop

