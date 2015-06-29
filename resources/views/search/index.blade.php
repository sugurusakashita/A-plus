@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
WjinkaProj | 検索
@stop

@section('main_content')
<form action="/search" method="get">
	<table class="table table-bordered">
    <thead>
	    <tr>
	      <th>検索ワード</th>
	      <th>曜日</th>
	      <th>時限</th>
	      <th>学期</th>
      </tr>
    </thead>
	  <tbody>
	      <td>
	      	<div class="form-element-group">
	      		<input class="form-element" type="text" size="20" placeholder="授業名を入力" name="q" value="{{{ $data['get']['q']? $data['get']['q']:"" }}}"/>
      	     <span class="form-group-btn">
      	      <button class="btn btn-default btn-primary" type="submit">検索</button>
      	     </span>
  	    </div>
	      </td>
	      <td>
		      <select name="day">
		      	<option value="0">指定なし</option>
		      <?php
		      	$days = ["指定なし","月","火","水","木","金","土","夏季"];
		      	for($i = 1;$i < 7;$i++){

		      		$str =  "<option value=".$days[$i];
		      		$str .= $data['get']['day'] == $days[$i]? " selected >":" >";
		      		$str .= $days[$i]."</option>";
		      		echo $str;
		      	}
		      ?>
		      </select>
				</td>
	      <td>
	      	<select name="period">
	      		<option value="0">指定なし</option>
	      	<?php
	      		for($i = 1;$i < 8;$i++){
	      			$str =  "<option value=".$i;
	      			$str .= $data['get']['period'] == $i? " selected >":" >";
	      			$str .= $i."限</option>";
	      			echo $str;
	      		}
	      	?>
	      	</select>
	      </td>
	      <td>
	      	<select name="term">
	      		<option value="2"  {{{ $data['get']['term'] == 2? "selected":"" }}}>指定なし</option>
	      		<option value="0"  {{{ $data['get']['term'] == 0? " selected":"" }}}>春学期</option>
	      		<option value="1"  {{{ $data['get']['term'] == 1? " selected":"" }}}>秋学期</option>
	      	</select>
	      </td>
	    </tr>
	  </tbody>
	</table>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<div class="panel panel-info" style="margin-bottom: 15px;">
	<div class="panel-body">
		<?php
			$term = ["春学期 ","秋学期 "];
			echo $data['get']['term'] == 2? "":$term[$data['get']['term']];
				if($data['get']['day']){
					echo  $data['get']['day'];
					if($data['get']['day'] != "夏季"){
						echo "曜日 ";
					}
				}
			echo $data['get']['period']? $data['get']['period']."限 ":"";
			echo '「'.$data['get']['q'].'」の検索結果'
		?>
		<?php echo $data['classes']->total()? $data['classes']->total()."件ヒットしました！":"";?>
	</div>
</div>
@if($data['classes']->count())
	@foreach ($data['classes'] as $class_data)

	<div style="margin-bottom: 15px;">
			<ul class="list-group">
			  <li class="list-group-element"><span class="badge info">{{ $class_data->class_week }}</span>　<span class="badge warning"><?php echo $class_data->class_period === "00"? "その他":$class_data->class_period."限"; ?></span></li>
			  <li class="list-group-element">
			  	<a href="classes/index/{{ $class_data->class_id }}">{{ $class_data->class_name }}</a>			  	
			  		<?php
			  			$class_id = $class_data->class_id;
			  			$review_count = $data['review']->where("class_id","=",$class_id)->get()->count();
			  			$tags = $data['tag']->where("class_id","=",$class_id)->get();
			  		?>
			  		<p>
			  		@if($review_count)
			  		
			  			レビュー件数:  {{ $review_count }}件あります！	  		
			  		@endif 
			  		</p>
			  		@if($tags)
			  			@foreach($tags as $tag)
					  		<span class="btn-label info">
					  			{{ $tag->tag_name }}
					  		</span>	
			  			@endforeach
			  		@endif
			  </li>

			  @if($class_data->teachers()->get()->count())
			  <li class="list-group-element">
			  	@foreach($class_data->teachers()->get() as $teacher)
			 	 <a href="/search/">{{ $teacher->teacher_name }}</a>
			 	@endforeach
			  </li>
			  @endif

			  @if($class_data->summary)
			  <?php 
			  	//要約作成
			  	$summary = mb_strimwidth($class_data->summary,0,200,"...");
			  ?>
			  <li class="list-group-element">
			  	<p>{{ $summary }}</p>
			  </li>
			  @endif
			</ul>
	</div>

	@endforeach
@else
	<p style='color: #FF0000;'>検索結果が存在しませんでした。<br />再検索してください。</p>
@endif

	<div style="margin: 20px auto; height: 40px;">
		<?php echo $data['classes']->render(); ?>
	</div>

@stop