@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('meta')
<meta name="description" itemprop="description" content="{{ $detail['class_name'] }}の授業情報とレビュー " />
<meta name="keywords" itemprop="keywords" content="{{ $detail['class_name'] }},A+plus,早稲田,所沢キャンパス,所キャン" />
<meta name="twitter:card" content="summary" />
<meta property="og:title" content="{{ $detail['class_name'] }} | A+plus" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:image" content="{{ url('image/top/top-main.gif') }}" />
<meta property="og:site_name" content="早稲田大学所沢キャンパス 授業レビューサイト A+plus" />
<meta property="og:description" content="{{ $detail['class_name'] }}の授業情報とレビュー " />
<meta itemprop="image" content="{{ url('image/top/top-main.gif') }}" />
@endsection

@section('title')
{{ $detail['class_name'] }} | A+plus
@stop

@section('main_content')

			<div id="modal-content">
				<div class="panel panel-primary">
					<div class="panel-title">履修済登録</div>
					<div class="panel-body">
						<p style="margin-bottom:10px;">この授業の受講年度を選んでください。</p>
						<div>
							<select id="year" style="margin-bottom:20px;">
								<option value="2015">2015年度</option>
								<option value="2014">2014年度</option>
								<option value="2013">2013年度</option>
								<option value="2012">2012年度</option>
								<option value="2011">2011年度</option>
								<option value="2010">2010年度</option>
								<option value="2009">2009年度</option>
								<option value="2008">2008年度</option>
							</select>
						</div>
						@if(Auth::user()->faculty != $detail->faculty)
							<div style="color:red;">あなたの所属する学部と、登録しようとしている授業の設置学部が異なります。</div>
							<div>それでも登録する場合は「登録」ボタンを押してください。</div>
							<br>
						@endif
						<button class="btn btn-primary" type="submit" id="add_register">登録</button>
						<button class="btn btn-warning" type="submit" id="modal-close">キャンセル</button>
					</div>
				</div>
			</div>

			<div class="col-md-12">
			 @if($tag['add_result']->added_tag)
			 	<p style="color:red;">タグが追加されました。</p>
			 @endif
			 @if($tag['add_result']->deleted_tag)
			 	<p style="color:red;">タグが削除されました。</p>
			 @endif

			<div style="margin: 0 auto 20px;">

				<!-- タイトル -->
				<div class="alert a-is-info" style="margin: 0 auto 5px;">
					<div class="row-fluid">
						<h2 class="col10 class-name">{{ $detail->class_name }}</h2>
						@if(Auth::check())
							<!-- <button class="col2 btn btn-primary" style="height:39px;" type="submit" id="add_register">履修済登録</button> -->
						@endif
					</div>
				<span class="raty_stars_average"></span>
				</div>

				<!-- タグ作ってる -->
				<div id="tag-list" style="padding: 10px;">
			 	@if($tag['list'])
				 		@foreach($tag['list'] as $t)
				 		<span class="btn-label info">
				 				<input class="delete-tag-button" type="submit" value="×" style="color: black; margin: auto 0;">
				 				<span style="color: white; font-size: 1.5em;">#{{ $t->tag_name }}</span>
			 			</span>
				 		@endforeach
			 	@endif
			 	</div>

			 	<!-- タグの追加 -->
			 	<div class="add_tag">
			 				<span class="col6 tag-full-btn">
					 			<a href="/tag/add/{{ $detail->class_id }}" style="color: white;">
					 				<button class="btn btn-pill btn-warning-outline btn-full">リストからタグを追加</button>
					 			</a>
					 		</span>
					 		<span class="col6 tag-full-btn">
					 			<button class="btn btn-pill btn-warning-outline btn-full" id="add-new-tag">新しくタグを追加</button>
					 		</span>
			 		<div class="new-tag-field">
			 			<input class="form-element col8" type="text" size="32" placeholder="ここに新しいタグを入力!" required id="add-tag-filed" value=""/>&nbsp;
			 			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			 			<button class="btn btn-default col3" type="submit" id="add-tag-button">追加</button>
			 		</div>
			 	</div>

			 	<div class="tab-index">
			 		<ul>
			 			<li class="active"><a href="#tab1"><span class="icon-price-tag"></span> 基本情報</a></li>
			 			<li><a href="#tab2"><span class="icon-pencil2"></span> みんなのレビュー</a></li>
			 		</ul>
			 	</div>
			 	<div id="tab1" class="tab-contents active">
					<!-- 基本情報 -->
					<table class="table table-bordered" style="margin: 20px auto;">
					  <thead>
					    <tr>
					      <th>担当講師</th>
					      <th>学期</th>
					      <th>曜日</th>
					      <th>時限</th>
					      <th>教室</th>
					    </tr>
					  </thead>
				    <tbody>
				      <tr>
				        <td>
				        	@if($teacher)
				        		@foreach($teacher as $teacher)
				        			<a href="/search?q={{ urldecode($teacher->teacher_name) }}&_token={{csrf_token()}}">{{ $teacher->teacher_name }}</a>
				        		@endforeach
				        	@endif
				        </td>
				        <td><?php echo $detail->term?></td>
				        <td><?php echo $detail_wpr->class_week?></td>
				        <td><?php echo $detail_wpr->class_period?>限</td>
				        <td>{{ $detail_wpr->room_name }}</td>
				      </tr>
				    </tbody>
					</table>
					<!-- 成績評価方法 -->
					<div style="overflow:auto;">
						<div class="col6" >
							<h3><span class="icon-chart icons"></span>成績評価方法</h3><hr>
							<svg id="eval_pie"></svg>
						</div>
						<div class="col6">
							<h3><span class="icon-star-full icons"></span>みんなの評価</h3><hr>
							<table class="table table-bordered evaluation-display">
								<tbody>
									<tr>
										<th>総合</th>
										<td><span class="raty_stars_average"></span></td>
									</tr>
									<tr>
										<th>単位の取りやすさ</th>
										<td><span class="raty_credit_average"></span></td>
									</tr>
									<tr>
										<th>GP(成績)の取りやすさ</th>
										<td><span class="raty_grade_average"></span></td>
									</tr>
							      	<tr>
							      		<th>内容の充実度</th>
							        	<td><span class="raty_grade_average"></span></td>
							      	</tr>
								</tbody>
							</table>
							@if($detail->faculty === "スポーツ科学部")
							<p style="color:red">※スポーツ科学部における一部授業の成績評価法、教師データに関しては10月中に対応予定です。</p>
							@endif
						</div>

						@if($attendance_data)
						<div class="col6">
							<h3><span class="icon-user-check icons" style="top:3px; position:relative;"></span>出席</h3><hr>
							<div id="attendance_data"></div>
						</div>
						@endif
						@if($bring_data)
						<div class="col6">
							<h3><span class="icon-briefcase icons"></span>テストの持ち込み</h3><hr>
							<div id="bring_data"></div>
						</div>
						@endif
					</div>

				 	<!-- 授業要旨 -->
					@if($detail->summary)
					<div class="panel panel-info" style="margin: 20px auto;">
					 	<div class="panel-title">
					   		授業要旨
					 	</div>
					 	<div class="panel-body">
					 		{{ $detail->summary }}
					 	</div>
					</div>
						<a href="{{ $actual_syllabus_url }}" target="_blank"><button class="btn btn-info">公式シラバスを見る</button></a>
						@if(Auth::check())
							<button class="btn btn-primary" style="height:39px;" type="submit" id="add_register_modal">履修済登録</button>
						@endif
						<div class="class-share section-margin">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="{{ $detail->class_name }}の授業レビュー / 早稲田大学所沢キャンパス 授業レビューサイト A+plus" data-count="vertical"　data-via="waseda_Aplus" data-lang="ja" data-hashtags="エイプラ">ツイート</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							<div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="box_count"></div>
						</div>
					<div class="check-official-data warning-text">
						<p>授業情報は常に変更がございます。特に履修時は、必ず公式シラバスや履修登録ページで確認してください。</p>
					</div>
					@endif
			 	</div>
			 	<div id="tab2" class="tab-contents">
				@if(!$review->count())
					<div class="alert a-is-danger alert-removed fade in no-review" style="margin: 20px auto;">
						この授業はまだレビューされていません。
					</div>
				@else
				<p style="font-size:15px;">レビューの書き直しは<a href="/mypage/index">マイページ</a>からできます</p>
					<div id="review-list">
						@foreach($review as $r)
						<div class="panel panel-primary section-margin">
								<div class="panel-title review-panel-title">
									<div class="row-fluid">
										<div class="col9">
											<img src="{{ isset($r->users()->first()->avatar)? $r->users()->first()->avatar:asset('/image/dummy.png') }}" width="70"height="70" alt="reviewer_avatar" style="vertical-align:top;">
											<div class="reviewer-info">
												<p style="margin-top:3%;">{{ isset($r->users()->first()->name)? $r->users()->first()->name:"不明なユーザ" }}</p>
												<p>総合 <span class="reviewer-stars" data-star="{{ $r->stars }}"></span></p>
											</div>
										</div>
										<div class="col3">
											<span class="icon-clock"></span> {{ $r->updated_at}}
										</div>
									</div>
								</div>
							<div class="panel-body">
								<?php echo nl2br($r->review_comment); ?>
							</div>
						</div>
						@endforeach
					</div>
					@endif
					@if(!Auth::check())
					<!-- ゲストユーザのみ -->
					<div style="col12">
							<div style="text-align:center;">
								<h3><span class="icon-pencil2 icons"></span>レビューする！</h3>
								<p>もし、この授業を履修したことがあれば、簡単なレビューをしていただけませんか？</p>
							</div>
						<a href="/auth/login">
							<img src="/image/guest_review.png" alt="レビューはログイン後にできます" width="100%">
						</a>
					</div>
					@elseif(!$wrote_review)
					<!-- レビュー書いたことないユーザのみ -->
					<div id="review-form">
					<!-- レビューフォーム -->
				        <div id="validation-error-field" class="alert alert-danger" style="display:none;">
				          <p>
				          入力の一部に誤りがあります。</p><br><br>
				          <ul>
				          </ul>
				        </div>
						<form action="/classes/confirm" method="POST">
							<div style="text-align:center;">
								<h3><span class="icon-pencil2 icons"></span>レビューする！</h3>
								<p>もし、この授業を履修したことがあれば、簡単なレビューをしていただけませんか？</p>
							</div>
							<hr>
							<div style="overflow:auto;">
								<div class="col6">
									<table class="table table-bordered" >
										<tbody>
										    <tr>
										      	<th>総合</th>
										      	<td class="raty_stars" data-number="{{ old('stars') }}"></td>
										    </tr>
										    <tr>
										    	<th>単位の取りやすさ</th>
										    	<td class="raty_unit_stars" data-number="{{ old('unit_stars') }}"></td>
										    </tr>
									      	<tr>
									      		<th>GP(成績)の取りやすさ</th>
									        	<td class="raty_grade_stars" data-number="{{ old('grade_stars') }}"></td>
									      	</tr>
									      	<tr>
									      		<th>内容の充実度</th>
									        	<td class="raty_fulfill_stars" data-number="{{ old('fulfill_stars') }}"></td>
									      	</tr>
								   		</tbody>
									</table>
									<p class="right-float">☆をクリックして選択してください！</p>
								</div>
								<div class="col6">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<th>受講した学年</th>
												<td>
													<select name="grade">
														<option value="1">1年</option>
														<option value="2">2年</option>
														<option value="3">3年</option>
														<option value="4">4年</option>
														<option value="5">5年以上</option>
													</select>
												</td>
											</tr>
									      	<tr>
									      		<th>出席</th>
									        	<td>
									        		<ul>
										        		<li><input type="radio" name="attendance" checked value="">わからない</li>
										        		<li><input type="radio" name="attendance" {{ old('attendance') === '常に取る'? 'checked':'' }} value="常に取る">常に取る</li>
										        		<li><input type="radio" name="attendance" {{ old('attendance') === 'たまに取る'? 'checked':'' }} value="たまに取る">たまに取る</li>
										        		<li><input type="radio" name="attendance" {{ old('attendance') === '取らない'? 'checked':'' }} value="取らない">取らない</li>
									        		</ul>
									        	</td>
									      	</tr>
									      	@if($detail->exam > 0)
									      	<tr>
									      		<th>試験の持ち込み</th>
									      		<td>
									        		<ul>
										        		<li><input type="radio" name="bring" checked value="">わからない</li>
										        		<li><input type="radio" name="bring" {{ old('bring') === 'レジュメ・教科書共に可'? 'checked':'' }} value="レジュメ・教科書共に可">レジュメ・教科書共に可</li>
										        		<li><input type="radio" name="bring" {{ old('bring') === 'レジュメのみ可'? 		'checked':'' }} value="レジュメのみ可">レジュメのみ可</li>
										        		<li><input type="radio" name="bring" {{ old('bring') === '教科書のみ可'? 			'checked':'' }} value="教科書のみ可">教科書のみ可</li>
										        		<li><input type="radio" name="bring" {{ old('bring') === '不可'? 				'checked':'' }} value="不可">不可</li>
									        		</ul>
									      		</td>
									      	</tr>
									      	@endif
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group">
								<label>授業の感想 <span class="warning-text">※必須</span></label>
								<textarea placeholder="例) 大学生活において必要なスキルを学ぶための授業。レポートの正しい書き方、Macbookの使い方などを学ぶ。先生はおおらかな人なので遅刻は厳しくない。しかし、声が小さく、スライドも文字が小さいので理解しにくい。最終レポートは1000字だが、出せば単位は来る" name="review_comment" rows="7" class="form-control form-element">{{ old('review_comment') }}</textarea>
								<div class="warning-text">
									<p>感想は特定の人物、特に講師の誹謗中傷は固く禁止します。<br>万が一、そのような投稿がみられる場合はレビューの削除及び、アカウントの凍結を予告なしにする場合がございますのでご了承ください。</p>
								</div>
							</div>
							<button type="button" class="btn btn-primary review-submit-button">レビューする！</button>
							<input type="hidden" name="class_id" value="{{ $detail->class_id }}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						</form>
					</div>
					@endif
				</div>
			</div>
			<!-- <a href="/search"><button class="btn btn-sm btn-default" style="margin-bottom: 20px;">検索結果に戻る</button></a> -->
		</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('/js/d3.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/pie_graph.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/bar_graph.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
	<script type="text/javascript">
		var class_id = <?php echo $detail->class_id; ?>;
		var user_id = <?php echo Auth::user()->user_id; ?>;
		//グラフデータ
			var attendance_data = <?php echo $attendance_data ?: "null"; ?>;
			var bring_data = 	  <?php echo $bring_data 	  ?: "null"; ?>;
			// 円グラフ用JS
			evaluation_data = <?php echo $evaluation ?: '[{"legend":"データがありません","value":100,"color":"#e74c3c"}]'  ?>;

			//テスト用
			var w = new pieClass("#eval_pie");
			//初回読み込み
		    w.render(evaluation_data);
		    w.update();
		    w.animate(evaluation_data);
			if(bring_data !== null){
				var b = new barClass('#bring_data',bring_data);
				b.barGraph();
			}
			if(attendance_data !== null){
				var a = new barClass('#attendance_data',attendance_data);
				a.barGraph();
			}
	</script>
	<script type="text/javascript" src="{{ asset('/js/classes.js') }}"></script>
@stop
