@section('header')
<!doctype>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="header">
		<div class="search_header" style="margin:60px; text-align:center;">
			<form action="/search" method="get">
				<input type="text" placeholder="授業や講師名で検索！" size="20" name="q" />
				<input type="hidden" name="day" value="0" />
				<input type="hidden" name="period" value="0" />
				<input type="hidden" name="term" value="2" />
				<input type="submit" value="検索" />
				<input type="hidden" name="_token" value="{{csrf_token()}}">
			</form>
		</div>
	</div>
	<hr>
@stop

