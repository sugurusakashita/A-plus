<!doctype>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=1">
    <title>
        @yield('title')
    </title>
    <link href="{{ asset('/css/schema.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
    <![endif]-->
</head>
<body>
  @include('common.header')
	<div class="container">
		<div class="search_header" style="margin-top:20px; text-align:center;">
			<form action="/search" method="get">
        <div class="form-element-group">
          <input type="text" class="form-element" placeholder="授業や講師名で検索！" name="q"/>
          <input type="hidden" name="day" value="0" />
          <input type="hidden" name="period" value="0" />
          <input type="hidden" name="term" value="2" />
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <span class="form-group-btn">
            <button class="btn btn-default btn-primary" type="submit">検索</button>
          </span>
        </div>
			</form>
		</div>
	</div>

  <div class="container">
      <div class="row-fluid">
        <div class="col8">
          @yield('main_content')
        </div>
        <div class="col4">
          @yield('sidebar')
        </div>
      </div>
  </div>
  @include('common.footer')
</body>
</html>