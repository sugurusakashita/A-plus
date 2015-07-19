@extends('full')

@section('title')
A+plus
@stop

@section('main_content')
<style type="text/css">
   body{
      background-color: #486d46;
      background-image: url("{{ asset('image/bg_top_filtered.jpg') }}");
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
   }
/*   section:before{
     content: "";
     z-index: -1;
     -webkit-filter: blur(4px);
     -ms-filter: blur(4px);
     filter: blur(4px);
     position: absolute;
     width: 100%;
     height: 100%;
     margin: 0;
     padding: 0;
   } */
   .img_container{
      background-color: rgba(255,255,255,0.85);
      width: 100%;
   }
   .bland_img{
      display: block;
      /*background-color: rgba(255,255,255,0.5);*/
      margin: 12% auto 7%;
   }
   .search_header{
      width:50%;
      margin: 0 auto 20%;
   }
</style>
  <div class="container">
    <div class="img_container">
       <img class="bland_img" src="{{ asset('image/A+plus_logo_trans@1x.png') }}" alt="a+plus_logo" width=510>
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