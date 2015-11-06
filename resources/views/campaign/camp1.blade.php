@extends('master')

@section('sidebar')
	@include('common.sidebar')
@stop

@section('meta')
<meta name="description" itemprop="description" content="大学生活をさらにスマートに。さらに賢く。" />
<meta name="keywords" itemprop="keywords" content="A+plus,キャンペーン,Amazonギフト券,レビュー,早稲田" />
<meta name="twitter:card" content="summary_large_image" />
<meta property="og:title" content="会員登録・レビューでAmazonギフト券1000円分キャンペーン | A+plus" />
<meta property="og:url" content="{{ url('campaign/index',[1]) }}" />
<meta property="og:image" content="{{ asset('image/campaign/event1-lg.png') }}" />
<meta property="og:site_name" content="早稲田大学所沢キャンパス 授業レビューサイト A+plus" />
<meta property="og:description" content="A+plusでは早稲田大学所沢キャンパスの授業レビューを提供しています。" />
<meta itemprop="image" content="{{ asset('image/top/top-main.gif') }}" />
@stop
@section('title')
	会員登録・レビューでAmazonギフト券1000円分キャンペーン(終了) | A+plus
@stop

@section('main_content')
	<div class="alert a-is-info" style="margin: 0 auto 5px;">
		<p>会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン</p>
		<p style="color:red;">本キャンペーンは終了しました。</p>
	</div>
	<div>
		<img class="header-campaign-image"src="/image/campaign/event1-lg.png" alt="会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン">
	</div>
    <div class="panel panel-warning section-margin">
    	<div class="panel-title">
    		<span class="icon-plus footer-header-icon"></span>はじめに
    	</div>
    	<div class="panel-body">
		    <p>みなさま、はじめまして。A+plusです。</p>
		    <p>こんなサービスに興味を持っていただき、ありがとうございます。</p>
		    <p>そして、こんなに早くにA+plusを見つけてくださったこと、とても嬉しく思います。<br>そんな、誰よりも先に使ってくださるみなさんに、最大限の感謝を込めて、<b>キャンペーンを開催しちゃいます。</b></p>
	    </div>
    </div>
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>キャンペーン参加方法
    	</div>
    	<div class="panel-body">
    		<p>以下の条件をすべて満たし、ページ下部のSNSで応募(タイムラインにシェア)完了で本キャンペーンのエントリーが完了いたします。</p><br>
		    <ul>
		    	<li><b>条件1: 無料会員登録をします</b></li>
			    <li><b>条件2: 授業のレビューを５件以上登録</b></li>
		    </ul>
		    <p style="color:red">更に！新学期キャンペーンとして、秋学期の授業レビューなら３件以上のレビューで条件2をクリア！ </p>
		    <p class="campaign-detail">※この場合、3件すべて秋学期でなくてはいけません。</p>
		    <p class="campaign-detail">※ここでの秋学期とは、検索オプションの「学期」で「秋学期」に所属する授業群を指します。</p>
		    <p class="campaign-detail">※シェアした後に条件を満たしてもエントリーとなります。</p>
	    </div>
    </div>
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>キャンペーン期間
    	</div>
    	<div class="panel-body">
    		<s>リリース日〜2015年9月17日 23:59迄</s>
	    </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>特典
    	</div>
    	<div class="panel-body">
		    <p class="lead">抽選で25名様にAmazon.co.jp®で使える<span style="color:#FC9A18">Amazonギフト券</span>1000円分プレゼント！</p>
		    <p>まだまだユーザーが少ないので、<b>当たる確率は大きいかも！？！？</b></p>
		    <p>サークル合宿や新学期で何かとお金の飛んで行くこの季節、ぜひゲットしてください！</p>
		    <div>
			    <p class="campaign-detail">※当選した方には確認メールを送らせていただきます。送信から一週間以上ご連絡がつかない場合、当選取り消しとなりますのでご了承ください。</p>
			    <p class="campaign-detail">※当キャンペーンの実施は大学当局およびAmazon.co.jp®とは一切関係ありません。</p>
			    <p class="campaign-detail">※このキャンペーンのお問い合わせに関しては<a href="/help/inquiry">こちら</a>まで</p>
		    </div>
	    </div>
    </div>
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>おわりに
    	</div>
    	<div class="panel-body">
		    <p>みなさまの参加、お待ちしております。</p>
		    <p>A+plusの詳しい利用方法は<a href="/help/manual">こちら</a>をご確認ください。
		    <p>それでは、新しい大学生活のスタートです！</p><br>
		    <p>Team A+plus</p>
    	</div>
    </div>

@stop

@section('js')
	<script type="text/javascript" src="{{ asset('js/campaign.js') }}"></script>
@stop