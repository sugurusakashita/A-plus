@extends('full')

@section('title')
A+plus
@stop

@section('main_content')
<style type="text/css">
   body {
/*      background-color: #486d46;
      background-image: url("/image/top_back.jpg");
      background-size: cover;
      background-attachment: fixed;
      background-position: center center;*/
   }
   .nav {
     background-color: rgba(0,0,0,0);
   }
   .bland_img{
      display: block;
      margin: 12% auto 7%;
   }
   .search_header{
      width:50%;
      margin: 0 auto 20%;
   }
</style>
  <div class="container">
    <div>
       <img class="bland_img" src="{{ asset('image/A+plus_logo@1x.png') }}" alt="a+plus_logo" width=510>
    </div>
    <div class="search_header">
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
@stop