<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<?php
if(!$data['classes']){
	echo "<p style=' color: #FF0000;'>検索結果が存在しませんでした。</p>";
}
	foreach ($data['classes'] as $class_data) {
		echo "<p>".$class_data->class_week."</p>";
		echo $class_data->class_period === "00"? "NaN":"<p>".$class_data->class_period."限</p>";
		echo "<p>".$class_data->class_name."</p><hr>";
	}
?>
</body>
</html>
