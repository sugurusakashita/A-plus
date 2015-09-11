@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
A+plusの使い方 | A+plus
@stop

@section('main_content')
<div class="alert a-is-info" style="margin: 0 auto 5px;">
	<p>A+plusの使い方<br>
        <a href=#regi>会員登録</a>&nbsp;|&nbsp;<a href=#search>授業の検索</a>&nbsp;|&nbsp;
        <a href=#view>授業詳細ページ</a>&nbsp;|&nbsp;<a href=#mypage>マイページ
        </a>&nbsp;|&nbsp;<a href=#other>その他</a>
    </p>
    <p class="warning-text" style="color:red;">※画面は全て、製作中のものです。現在のバージョンと異なることがございます。<br>※PCサイトを元に解説しています。</p>
</div>
<div id="regi">
    <div class="panel panel-warning section-margin">
    	<div class="panel-title">
    		<span class="icon-plus footer-header-icon"></span>会員登録
    	</div>
    	<div class="panel-body">
            <p>画面右上の新規登録をクリック</p>
            <p class="campaign-detail">※未登録の場合でもご利用いただけますが、一部機能に制限がかかります。</p>
             <img class="manual-img" src="/image/help/exlogin.png" alt="新規登録方法">
            <p>各プロフィールを入力</p>
            <p class="campaign-detail">※SNSアカウントで登録いただけるとスムーズです。</p>
            <img class="manual-img" src="/image/help/exregi.png" alt="登録画面">
            <p>全てを正しく入力したことを確認したら、登録ボタンをクリック。</p>
           <p class="lead">必ず「利用規約」をご確認下さい。</p>
            <img class="manual-img" src="/image/help/exregi2.png"　alt="利用規約をご覧ください">
	    </div>
    </div></div>
<div id="search">
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>授業の検索
    	</div>
    	<div class="panel-body">
            <p>トップページ中央または各ページ左上の検索窓にキーワードを入力することで、授業を検索することができます。</p>
            <img class="manual-img" src="/image/help/exsearchtop.png" alt="トップ検索">
            <img class="manual-img" src="/image/help/exsearchheader.png" alt="ヘッダー検索">
		    <p>検索ページではより細かい検索項目を設定できます。</p>
            <img class="manual-img" src="/image/help/exsearch.png" alt="検索オプション">
            <p>検索結果では、学部・授業の曜日・時限・レビューの件数・科目名・タグ(あれば)・担当講師・授業の概要が表示されます。</p>
            <img class="manual-img" src="/image/help/exsearchresult.png" alt="検索結果">
            <p>科目名をクリックすると授業の詳細ページを、講師名をクリックするとその講師が担当する授業一覧を表示することができます。</p>
	    </div>
    </div>
</div>
<div id="view">
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>授業詳細ページ
    	</div>
    	<div class="panel-body">
    		<p>一番上は授業名、その下の星は登録されたレビューのうちの総合評価を表しています。</p>
            <p>緑の「タグ」は自由に追加・削除ができます。削除は×印を、追加は下の追加ボタンをクリック。</p>
            <img class="manual-img" src="/image/help/exclasstop.png" alt="授業ページヘッダ">
            <p>成績評価方法は公式シラバスの情報をもとにA+plusが作成したものです。</p>
            <p>みんなの評価は会員が登録したレビューです。出席は投票制で、会員の支持率により出席の有無を予測することができます。</p>
            <img class="manual-img" src="/image/help/exreviewview.png" alt="成績評価法">
            <p>授業要旨は公式シラバスのものです。「公式シラバスを見る」をクリックすることで、公式ウェブシラバスのページを見ることができます。</p>
            <img class="manual-img" src="/image/help/exclasssummary.png" alt="シラバス">
            <p>「みんなのレビュー」タブをクリックすることで、会員が登録したレビューを確認することができます。</p>
            <img class="manual-img" src="/image/help/exreview.png" alt="レビュー一覧">
            <p>「レビューする」欄ではあなたのレビューを簡単に投稿することが可能です。レビューの変更はマイページから行うことができます（詳しくは<a href =#mypage>こちら</a>）。</p>
            <img class="manual-img" src="/image/help/exreviewpost.png" alt="レビューフォーム">
	    </div>
    </div>
</div>
<div id="mypage">
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>マイページ
    	</div>
    	<div class="panel-body">
		    <p>マイページでは、登録したプロフィールやメールアドレスの変更、投稿したレビューの管理などができます。</p>
		</div>
	</div>
</div>
<div id="other">
    <div class="panel panel-warning section-margin">
        <div class="panel-title">
			<span class="icon-plus footer-header-icon"></span>その他
    	</div>
    	<div class="panel-body">
		    <p>その他、何かご不明な点などあれば、<a href="/help/inquiry">お問い合わせフォーム</a>よりお願いいたします。</p>
    	</div>
    </div>
</div>

@stop