@extends('master')

@section('sidebar')
	@include('common.sidebar')
@stop

@section('title')
	会員登録・レビューでAmazonギフト券1000円分キャンペーン | A+plus
@stop

@section('main_content')
	<div class="alert a-is-info" style="margin: 0 auto 5px;">
		<p>会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン</p>
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
    		<p>以下の条件をすべて満たすことで本キャンペーンのエントリーが完了いたします。</p><br>
		    <ul>
		    	<li><b>条件1: 無料会員登録をします</b></li>
			    <li><b>条件2: 授業のレビューを５件以上登録</b></li>
			    <li><b>条件3: ページ下部の応募ボタンをクリックしてSNSで友達シェアの完了</b></li>
		    </ul>
		    <p style="color:red">更に！新学期キャンペーンとして、秋学期の授業レビューなら３件以上のレビューで条件2をクリア！ </p>
		    <p class="campaign-detail">※この場合、3件すべて秋学期でなくてはいけません。</p>
		    <p class="campaign-detail">※ここでの秋学期とは、検索オプションの「学期」で「秋学期」に所属する授業群を指します。</p>
	    </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>特典
    	</div>
    	<div class="panel-body">
		    <p class="lead">抽選で30名様にAmazon.co.jp®で使えるAmazonギフト券1000円分プレゼント！</p>
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
    <div class="campaign-submit-form">
		<div class="panel panel-warning">
			<div class="panel-title">
			  SNSで応募(タイムラインにシェア)
			</div>
			<div class="panel-body">
				<div class="social_register">
					<a href="" class="twitter"><span class="icon-twitter2 icons"></span>Twitter</a>
					<a href="" class="facebook"><span class="icon-facebook2 icons"></span>Facebook</a>
				</div>
			</div>
		</div>
    </div>
@stop