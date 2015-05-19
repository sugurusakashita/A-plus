@extends('master')

@section('title')
授業詳細 | <?php echo $data['detail']->class_name;?>
@stop

@section('body')
<div class ="container">
	<div class ="row">
		<h1><?php echo $data['detail']->class_name?></h1>
		<div class="col-md-12">
			<h2>担当講師 | <?php echo $data['detail']->teacher?></h2>
			<h3>学期 | <?php echo $data['detail']->term == 0? '春学期':'秋学期'?></h3>
			<h3>曜日 | <?php echo $data['detail']->class_week?></h3>
			<h3>時限 | <?php echo $data['detail']->class_period?>限</h3>

		</div>
	</div>
</div>
@stop