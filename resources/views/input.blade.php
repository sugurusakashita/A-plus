@extends('master')

@section('title')
input
@stop

@section('body')

<form action="res" method="post">
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

	<input type="submit" value="SEND">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
@stop