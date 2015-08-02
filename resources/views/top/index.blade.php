@extends('full')

@section('title')
A+plus
@stop

@section('main_content')
<style type="text/css">
  body{
    background-color: #fff;
    background-image: url("{{ asset('image/bg_top_filtered.jpg') }}");
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
  }
  .img_container{
    background-color: rgba(255,255,255,0.85);
    width: 100%;
  }
  .bland_img{
    display: block;
    margin: 12% auto 7%;
  }
  .search_header{
    width:50%;
    margin: 0 auto 20%;
  }
  @media screen and (max-width: 47.9375rem) {
    .bland_img{
      width: 80%;
    }
    .search_header{
       width:90%;
    }
  }
</style>
  <div class="container">
    <div class="img_container">
       <img class="bland_img" src="{{ asset('image/Aplus_logo_trans@1x.png') }}" alt="a+plus_logo" width=510>
    </div>
    <div class="search_header">
      <form action="/search" method="get">
        <div class="form-element-group">
          <input type="text" class="form-element" placeholder="授業や講師名で検索！" name="q"/>
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <span class="form-group-btn">
            <button class="btn btn-default btn-primary" type="submit">検索</button>
          </span>
        </div>
      </form>
    </div>
  </div>
@stop

@section('js')
  
    <script type="text/javascript"> 
      //アラートメッセージ用

      <?php
      if($v = $data["message"]){
          echo "alertify.success('".$v."');";        
      } 
      if($v = $data["alert"]){
          echo "alertify.error('".$v."');";        
      } 
      ?>    
    </script>
@stop