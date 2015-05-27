@extends('master')

@section('title')
WjinkaProj | トップ
@stop

@section('main_content')
	<h2 class="page-header">トップページ</h2>
	<div class="search_header" style="margin:30px">
		<form action="/search" method="get">
			<input type="text" placeholder="ここに検索ワードを" size="20" name="q" />
			<input type="hidden" name="day" value="0" />
			<input type="hidden" name="period" value="0" />
			<input type="hidden" name="term" value="0" />
			<input type="submit" value="検索" />
			<input type="hidden" name="_token" value="{{csrf_token()}}">
		</form>
		<blockquote>
		  <p>wjinkaは不滅だ</p>
		  <cite>@xk_vls</cite>
		</blockquote>
		<blockquote>
		  <p>今日もウイスキーが美味い</p>
		  <cite>@shalman</cite>
		</blockquote>
	</div>
@stop