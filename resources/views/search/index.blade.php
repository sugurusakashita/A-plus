@extends('master')

@section('title')
WjinkaProj | 検索
@stop

@section('body')
<div class ="container">
	<h1>授業検索ページ</h1>
	<div class="search_header" style="height:200px;margin:30px">
		<form action="/search" method="get">
			<div class="search" >
				<p>検索ワード</p>
					<input type="text" size="30" placeholder="授業名を入力" name="q"/>
					<input type="submit" value="検索">
			</div>
			<div class="search_option"> 
				<p>曜日</p>
					<select name="day">
						<option value="0">指定なし</option>
						<option>月</option>
						<option>火</option>
						<option>水</option>
						<option>木</option>
						<option>金</option>
						<option>土</option>
						<option>夏季</option>
					</select>
				<p>時限</p>
					<select name="period">
						<option value="0">指定なし</option>
						<option value="1">1限</option>
						<option value="2">2限</option>
						<option value="3">3限</option>
						<option value="4">4限</option>
						<option value="5">5限</option>
						<option value="6">6限</option>
						<option value="7">7限</option>
					</select>
				<p>学期</p>
					<select name="term">
						<option value="0">春学期</option>
						<option value="1">秋学期</option>
					</select>

				
				<input type="hidden" name="_token" value="{{csrf_token()}}">
			</div>
		</form>
	</div>
	<div style="text-align:center; margin:30px;">
	<p><?php 
		echo $data['get']['term'] == 0? "春学期 ":"秋学期 ";
			if($data['get']['day']){
				echo  $data['get']['day'];
				if($data['get']['day'] != "夏季"){
					echo "曜日 ";
				}	

			}
		echo $data['get']['period']? $data['get']['period']."限 ":"";
		echo '「'.$data['get']['q'].'」の検索結果'?></p>
	<p style="color:#FF0000;"><?php echo $data['classes']->total()? $data['classes']->total()."件ヒットしました！":"";?></p>
			<?php 
				
				echo "<p>".$data['classes']->currentPage().' / '.$data['classes']->lastPage()."</p>";
				echo $data['classes']->appends($data['get'])->render(); 
			?>
		</p>
	</div>
	
	<hr>
	<?php
	if($data['classes']->count()){
		foreach ($data['classes'] as $class_data) {
	?>
		
		<div>
			<a href="classes/index/<?php echo $class_data->id?>">
	<?php
			echo "<p>".$class_data->class_week."</p>";
			echo $class_data->class_period === "00"? "NaN":"<p>".$class_data->class_period."限</p>";
			echo "<p>".$class_data->class_name."</p><hr>";
	?>
			</a>
		</div>
		
	<?php
		}
	}else{
		echo "<p style=' color: #FF0000;'>検索結果が存在しませんでした。</p>";
	}
	?>
	<div style="text-align:center; margin:30px;">
			<?php 
				echo $data['classes']->appends($data['get'])->render(); 		
				echo "<p>".$data['classes']->currentPage().' / '.$data['classes']->lastPage()."</p>";
				
			?>
		
	</div>

</div>
@stop