@extends('master')

@section('sidebar')
  @include('common.sidebar')
@stop

@section('meta')
<meta name="description" itemprop="description" content="大学生活をさらにスマートに。さらに賢く。" />
<meta name="keywords" itemprop="keywords" content="A+plus,キャンペーン,Amazonギフト券,レビュー,早稲田" />
<meta name="twitter:card" content="summary_large_image" />
<meta property="og:title" content="会員登録・レビューでAmazonギフト券1000円分キャンペーン 第２弾| A+plus" />
<meta property="og:url" content="{{ url('campaign/index',[2]) }}" />
<meta property="og:image" content="{{ asset('image/campaign/event2-lg.png') }}" />
<meta property="og:site_name" content="早稲田大学所沢キャンパス 授業レビューサイト A+plus" />
<meta property="og:description" content="A+plusでは早稲田大学所沢キャンパスの授業レビューを提供しています。" />
<meta itemprop="image" content="{{ asset('image/top/top-main.gif') }}" />
@stop
@section('title')
  会員登録・レビューでAmazonギフト券1000円分キャンペーン　第２弾 | A+plus
@stop

@section('main_content')
  <div class="alert a-is-info" style="margin: 0 auto 5px;">
    <p>会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン　第２弾</p>
  </div>
  <div>
    <img class="header-campaign-image"src="/image/campaign/event2-lg.png" alt="会員登録・レビューでAmazonギフト券1000円分プレゼントキャンペーン">
  </div>
  <div class="panel panel-warning section-margin">
    <div class="panel-title">
      <span class="icon-plus footer-header-icon"></span>はじめに
    </div>
    <div class="panel-body">
      <p>秋学期がはじまりましたね！　A+plusです。</p>
      <p>みなさん、履修登録は順調ですか？</p>
      <p>「３次登録で残ってる授業、どんな感じなんだろう？」<br>「この授業３次登録で取り消すか迷ってるけど、誰かの話が聞きたいな」</p>
      <p>そんなときは、このA+plus、思い出してくださいね。</p>
      <p>そして、A+plusにレビューを投稿して、情報を共有しましょう！</p>
      <p><b>今なら、話題の"あの"キャンペーン、もう１回やってますよ！</b></p>
    </div>
  </div>
  <div class="panel panel-warning">
    <div class="panel-title">
       <span class="icon-plus footer-header-icon"></span>特典
    </div>
    <div class="panel-body">
      <p class="lead">抽選で15名様にAmazon.co.jp®で使える<span style="color:#FC9A18">Amazonギフト券</span>1000円分プレゼント！</p>
      <p>第１弾で当たった方もたくさんいます！<b>応募しない手はない！？！？</b></p>
      <div>
        <p class="campaign-detail">※当選した方には確認メールを送らせていただきます。送信から一週間以上ご連絡がつかない場合、当選取り消しとなりますのでご了承ください。</p>
        <p class="campaign-detail">※当キャンペーンの実施は大学当局およびAmazon.co.jp®とは一切関係ありません。</p>
        <p class="campaign-detail">※キャンペーン第１弾に当選された方はご応募いただけませんのでご了承ください。</p>
        <p class="campaign-detail">※このキャンペーンのお問い合わせに関しては<a href="/help/inquiry">こちら</a>まで</p>
      </div>
    </div>
  </div>
  <div class="panel panel-warning section-margin">
    <div class="panel-title">
		  <span class="icon-plus footer-header-icon"></span>キャンペーン詳細
  	</div>
  	<div class="panel-body">
      <div>
    		<p>以下の条件をすべて満たすことで本キャンペーンのエントリーが完了します。</p><br>
        <div class="panel panel-danger panel-body">
  	    <ul>
  	    	<li><b>STEP1: <a href="/auth/register">こちら</a>から無料会員登録をします</b></li>
          <li><b>STEP2: 以下の「SNSで応募」からTwitterかFacebookのどちらかをタップしてシェア！</b></li>
  		    <li><b>STEP3: 授業のレビューを<span style="color:red;">3件以上</span>登録！</b></li>
  	    </ul>
        </div>
        <p><b>しかも！！今回は第一弾と違い、学期関係なくレビューは<span style="color:red;">3件以上</span>でSTEP3がクリア！！</b></p>
  	    <p class="campaign-detail">※シェアした後にレビュー件数を満たしてもエントリーとなります。</p>
        <p class="campaign-detail">※STEP3におけるレビュー件数は、<b>今までにレビューされたものも含まれます！</b></p>
      </div>
      <div class="campaign-submit-form section-margin">
        <div class="panel panel-warning">
          <div class="panel-title">
            SNSで応募(タイムラインにシェア)
          </div>
          <div class="panel-body" style="overflow:auto;">
            @if(!Auth::check())
            <p style="color:red;">シェアする前にA+plusのログインが必要です。ログインは<a href="/auth/login">こちら</a>から</p>
            @endif
           <div class="col12">
             <div class="col6 text-center <?php if(!Auth::check()) echo 'is-disabled'; ?>" >
               <a href="{{ $data['twitter_url'] }}" target="_blank" class="btn btn-primary" id="entry-via-twitter" style="background-color:#00C6F2;">
                 <span class="icon-twitter2 icons"></span>Twitterでシェアする
               </a>
             </div>
             <div class="col6 text-center <?php if(!Auth::check()) echo 'is-disabled'; ?>" >
               <a href="{{ $data['facebook_url'] }}" target="_blank" class="btn btn-primary" id="entry-via-facebook" style="background-color:#3B5998;">
                 <span class="icon-facebook2 icons"></span>Facebookでシェアする
               </a>
             </div>
           </div>
           <p class="campaign-detail">※シェアだけではエントリーになりません。詳しくは上部条件をご確認ください。</p>
         </div>
        </div>
      </div>
      <div class="panel panel-primary section-margin">
        <div class="panel-title">
          あなたのキャンペーン参加状況
        </div>
        <div class="panel-body">
          <p><a href="/mypage/index#campaign2">マイページ</a>からでも確認できます！</p>
          @if(Auth::check())
          <p>{{ Auth::user()->name }}さんのキャンペーン参加状況:<b>{{ $data['camp2']['isEntry']? "エントリー済み！":"条件未達成" }}</b></p><br>
          <ul>
            <li><b>STEP1: <span style="color:red;">OK!!</span></b></li>
            <li><b>STEP2: <span style="color:red;">{{  $data['camp2']['step2']? 'OK!!': 'NG...' }}</span></b></li>
            <li><b>STEP3: <span style="color:red;">{{  $data['camp2']['step3']? 'OK!!': 'NG...(あと'.$data['diffReview'].'件のレビューでクリア！)' }}</span></b></li>
          </ul>
          @else
          <p style="color:red;">参加状況を確認するにはログイン、または新規登録が必要です。ログインは<a href="/auth/login">こちら</a>から</p>
          @endif
        </div>
      </div>
      <div class="panel panel-success section-margin">
        <div class="panel-title">
          みんなのキャンペーン参加状況
        </div>
        <div class="panel-body">
        　エントリー数:　<span style="font-size:24px;">{{ $data['count'] }}人</span>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-warning section-margin">
      <div class="panel-title">
		<span class="icon-plus footer-header-icon"></span>キャンペーン締め切り
  	</div>
  	<div class="panel-body">
  		<p>2015年10月2日 23:59迄</p>
      <p class="campaign-detail">※STEP3の対象レビューも上記日時までのものとします。</p>
      <p class="campaign-detail">※予告なしに、延長される場合がございます。</p>
    </div>
  </div>
  <div class="panel panel-warning section-margin">
      <div class="panel-title">
		<span class="icon-plus footer-header-icon"></span>おわりに
  	</div>
    	<div class="panel-body">
		    <p>みなさまの参加、お待ちしております。</p>
		    <p>A+plusの詳しい利用方法は<a href="/help/manual">こちら</a>をご確認ください。</p>
		    <p>ユーザー・レビューともに急増中！なA+plusに、今後もご期待ください！</p><br>
		    <p>Team A+plus</p>
      </div>
  </div>
@stop

@section('js')
  <script type="text/javascript" src="{{ asset('js/campaign.js') }}"></script>
@stop
