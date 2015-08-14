@extends('top')

@section('title')
A+plus
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="/css/sublimeSlideshow.css">
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
<div class="left">
  <div class="container">
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
</div>
@stop

@section('js')
    <script type="text/javascript" src="/js/jquery.sublimeSlideshow.js"></script>
    <script type="text/javascript">
    //スライドショー用
    $(function(){
        var device = ($(window).width() < 1021)? "sp":"pc";
        $.sublime_slideshow({
          src:[
          {url:"/image/top-"+device+"-img1.jpg",title:""},
          {url:"/image/top-"+device+"-img2.jpg",title:""},
          {url:"/image/top-"+device+"-img3.jpg",title:""},
          {url:"/image/top-"+device+"-img4.jpg",title:""},
          {url:"/image/top-"+device+"-img5.jpg",title:""},
          ],
          duration:   7,
          fade:       1,
          scaling:    1.2,
          rotating:   false,
          overlay:    "image/pattern.png"
        });
    });
    </script>
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