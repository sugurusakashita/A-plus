@extends('top')

@section('title')
A+plus
@stop

@section('css')
<style type="text/css">
  .header-field{
    background-color: #fff;
    background-image: url("{{ asset('image/bg_top_filtered.jpg') }}");
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    display: inline-block;
    margin-top: -25px;
  }
  .img_container{
    background-color: rgba(255,255,255,0.85);
    margin:12% 10%;
  }
  .bland_img{
    display: block;
    margin: 0 auto;
  }
  .search_header{
    width:50%;
    margin: 0 auto 20%;
  }

  .left{
    background-color: #F7F7F7;
  }

  .columns{
    margin: 20px 10px;
  }
  .articles{
    display: inline-block;
  }
  .article{
    margin: 5%; 
    height: 217px;
  }
  .article-img{
    width: 100%;
    margin: 0 auto;
    border:solid 1px #AFAFAF;
  }
  .article-summary{
    background-color: #BDBDBD;
  }
  @media screen and (max-width: 47.9375rem) {
    .bland_img{
      width: 80%;
    }
    .search_header{
       width:90%;
    }
    .article{
      margin: 15%;
    }
  }
</style>
@stop

@section('main_content')

  <div class="header-field">
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
  <div class="container left">
    <div class="row-fluid">
        <div class="col9">
          <div class="panel panel-info columns">
           <div class="panel-title">
            <h1><span class="icon-book icons"></span>News</h1>
          </div>
           <div class="panel-body">
            <div class="articles">
              <a href="" class="col4">
                <div class="article">
                  <img class="article-img" src="{{ asset('image/top_back.jpg') }}" alt="article1" >
                  <div class="article-summary">
                    <label>2015/08/06</label>
                    <label>ほげほげ</label>
                  </div>
                </div>
              </a>
              <a href="" class="col4">
                <div class="article">
                  <img class="article-img" src="{{ asset('image/bg_top_filtered.jpg') }}" alt="article1" >
                  <div class="article-summary">
                    <label>2015/08/06</label>
                    <label>ほげほげ</label>
                  </div>
                </div>
              </a>
              <a href="" class="col4">
                <div class="article">
                  <img class="article-img" src="{{ asset('image/Aplus_logo_global@1x.png') }}" alt="article1" >
                  <div class="article-summary">
                    <label>2015/08/06</label>
                    <label>ほげほげ</label>
                  </div>
                </div>
              </a>
            </div>
            <div class="articles">
              <a href="" class="col4">
                <div class="article">
                  <img class="article-img" src="{{ asset('image/top_back.jpg') }}" alt="article1" >
                  <div class="article-summary">
                    <label>2015/08/06</label>
                    <label>ほげほげ</label>
                  </div>
                </div>
              </a>
              <a href="" class="col4">
                <div class="article">
                  <img class="article-img" src="{{ asset('image/bg_top_filtered.jpg') }}" alt="article1" >
                  <div class="article-summary">
                    <label>2015/08/06</label>
                    <label>ほげほげ</label>
                  </div>
                </div>
              </a>
              <a href="" class="col4">
                <div class="article">
                  <img class="article-img" src="{{ asset('image/Aplus_logo_global@1x.png') }}" alt="article1" >
                  <div class="article-summary">
                    <label>2015/08/06</label>
                    <label>ほげほげ</label>
                  </div>
                </div>
              </a>
            </div>  
          </div>
        </div>
      </div>
      <div class="col3" class="side-content">
        <div class="panel panel-primary columns">
          <div class="panel-title">
            <h1>sidebar</h1>
          </div> 
          <div class="panel-body">
            <img class="article-img" src="{{ asset('image/Aplus_logo_global@1x.png') }}" alt="about_aplus" >
            <ul>
              <li><a href="/auth/facebook-oauth">facebookログイン/新規無料登録</a></li>
            </ul>
          </div> 
        </div>
      </div>
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