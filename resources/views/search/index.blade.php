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
WjinkaProj | 検索
@stop

@section('main_content')
	<h1>授業検索ページ</h1>
	<div class="search_header" style="height:200px;margin:30px">
		<form action="/search" method="get">
			<div class="search" >
				<p>検索ワード</p>
					<input type="text" size="30" placeholder="授業名を入力" name="q" value="{{{ $data['get']['q']? $data['get']['q']:"" }}}"/>
					<input type="submit" value="検索">
			</div>
			<div class="search_option"> 
				<p>曜日</p>
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
				<p>時限</p>
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
				<p>学期</p>
					<select name="term">
						<option value="2"  {{{ $data['get']['term'] == 2? "selected":"" }}}>指定なし</option> 
						<option value="0"  {{{ $data['get']['term'] == 0? " selected":"" }}}>春学期</option>
						<option value="1"  {{{ $data['get']['term'] == 1? " selected":"" }}}>秋学期</option>
					</select>

				
				<input type="hidden" name="_token" value="{{csrf_token()}}">
			</div>
		</form>
	</div>
	<div style="text-align:center; margin:30px;">
	<p><?php 
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
	</p>
	<p style="color:#FF0000;"><?php echo $data['classes']->total()? $data['classes']->total()."件ヒットしました！":"";?></p>
			<?php 
				
				echo "<p>".$data['classes']->currentPage().' / '.$data['classes']->lastPage()."</p>";
				echo $data['classes']->render(); 
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
			echo "<p>".$class_data->class_name."</p>";
	?>
				<hr>
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
				echo $data['classes']->render(); 		
				echo "<p>".$data['classes']->currentPage().' / '.$data['classes']->lastPage()."</p>";
				
			?>
		
	</div>
@stop