@extends('master')

@section('title')
WjinkaProj | トップ
@stop

@section('body')
<div class ="container">
	<div class="search_header" style="margin:30px">
		<form action="/search" method="get">
			<input type="text" placeholder="ここに検索ワードを" size="20" name="q" />
			<input type="hidden" name="day" value="0" />
			<input type="hidden" name="period" value="0" />
			<input type="hidden" name="term" value="0" />
			<input type="submit" value="検索" />
			<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
	</div>
<a href='/search'>詳細検索ページ</a>

</div>
@stop