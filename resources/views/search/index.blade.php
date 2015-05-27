@extends('master')

@section('sidebar')
<div class="sidebar">
	<div class="access_ranking" style="margin-bottom: 15px;">
		<div class="list-group">
		  <a class="list-group-element active">アクセスランキング</a>
		<?php
			$i = 1;
			foreach ($data['access_ranking'] as $ranking) {
				// aタグにしてあるから工夫次第でリンク張れる
				echo "<a class='list-group-element'><span class='badge success'>". $i ."</span>　" . $ranking->class_name."</a>";
				$i++;
			}
		?>
		</div>
	</div>

	<div class="search_word_ranking">
		<div class="list-group">
		  <a class="list-group-element active">人気検索ワードランキング</a>
		<?php
			$i = 1;
			foreach ($data['search_ranking'] as $ranking) {
				echo "<a class='list-group-element'><span class='badge success'>". $i ."</span>　".$ranking->word."</a>";
				$i++;
			}
		?>
		</div>
	</div>
</div>
@stop

@section('title')
WjinkaProj | 検索
@stop

@section('main_content')
	<h4>検索結果</h4>
	<div class="search_header" style="height:200px;margin:30px">
		<form action="/search" method="get">
			<table class="table">
			  <tbody>
			    <tr>
			      <td>検索ワード</th>
			      <td>
			      	<input type="text" size="20" placeholder="授業名を入力" name="q" value="{{{ $data['get']['q']? $data['get']['q']:"" }}}"/>
			      	<input type="submit" value="検索">
			      </td>
			    </tr>
			    <tr>
			      <td>曜日</th>
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
			    </tr>
			    <tr>
			      <td>時限</th>
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
			    </tr>
			    <tr>
			      <td>学期</th>
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