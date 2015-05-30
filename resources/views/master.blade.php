<!doctype>
<html lang="ja">
<head>
  @include('common.meta')
  <title>
      @yield('title')
  </title>
</head>
<body>
  <div class="container">
    @include('common.header')
  </div>
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