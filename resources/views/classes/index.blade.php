@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.core.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/aplus_style.css') }}">
@stop

@section('title')
{{ $data['detail']['class_name'] }} | A+plus
@stop

@section('main_content')

			<div class="col-md-12">
			 @if($data['tag']['add_result']->added_tag)
			 	<p style="color:red;">タグが追加されました。</p>
			 @endif
			 @if($data['tag']['add_result']->deleted_tag)
			 	<p style="color:red;">タグが削除されました。</p>
			 @endif

			<div style="margin: 0 auto 20px;">

				<!-- タイトル -->
				<div class="alert a-is-info" style="margin: 0 auto 5px;">
				 <p style="font-size: 1.75em;">{{ $data['detail']->class_name }}</p>
				 <span class="raty_stars_average"></span>
				</div>

				<!-- タグ作ってる -->
				<div id="tag-list" style="padding: 10px;">
			 	@if($data['tag']['list'])
				 		@foreach($data['tag']['list'] as $t)
				 		<span class="btn-label info">
				 				<input class="delete-tag-button" type="submit" value="×" style="color: black;">
				 				<a href="" style="color: white; font-size: 1.5em;">#{{ $t->tag_name }}</a>
			 			</span>
				 		@endforeach
			 	@endif
			 	</div>

			 	<!-- タグの追加 -->
			 	<div class="add_tag">
			 		<table style="width: 100%; text-align: center; background: none;">
			 			<tr><td>
					 		<a href="/tag/add/{{ $data['detail']->class_id }}" style="color: white;"><button class="btn btn-pill btn-info-outline">リストからタグを追加</button></a>&nbsp;
				 		</td><td>
					 		<button class="btn btn-pill btn-info-outline" id="add-new-tag">新しくタグを追加</button>
			 			</td></tr>
			 		</table>
			 		<div class="new-tag-field" style="width: 100%;">
			 			<input class="form-element col8" type="text" size="32" placeholder="ここに新しいタグを入力!" required id="add-tag-filed" value=""/>&nbsp;
			 			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			 			<button class="btn btn-default col3" type="submit" id="add-tag-button">追加</button>
			 		</div>
			 	</div>

			 	<div class="tab-index">
			 		<ul>
			 			<li class="active"><a href="#tab1">基本情報</a></li>
			 			<li><a href="#tab2">投票</a></li>
			 			<li><a href="#tab3">レビュー</a></li>
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
				        	@if($data['teacher'])
				        		@foreach($data['teacher'] as $teacher)
				        			<a href="/search?q={{ urldecode($teacher->teacher_name) }}&day=0&period=0&term=2&_token={{csrf_token()}}">{{ $teacher->teacher_name }}</a>
				        		@endforeach
				        	@endif
				        </th>
				        <td><?php echo $data['detail']->term == 0? '春学期':'秋学期'?></td>
				        <td><?php echo $data['detail']->class_week?></td>
				        <td><?php echo $data['detail']->class_period?>限</td>
				        <td>{{ $data['detail']->room_name }}</td>
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
							<h3><span class="icon-star-full icons"></span>評価度</h3><hr>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>総合評価度</th>
										<td><span class="raty_stars_average"></span>(5.0点)</td>
									</tr>
									<tr>
										<th>単位の取りやすさ</th>
										<td><span class="raty_credit_average"></span>(5.0点)</td>
									</tr>
									<tr>
										<th>GP(成績)の取りやすさ</th>
										<td><span class="raty_grade_average"></span>(5.0点)</td>
									</tr>
								</tbody>
							</table>
						</div>			
					</div>
				 	<!-- 授業要旨 -->
					@if($data['detail']->summary)
					<div class="panel panel-info" style="margin: 20px auto;">
					 <div class="panel-title">
					   授業要旨
					 </div>
					 <div class="panel-body">
					 	{{ $data['detail']->summary }}
					 </div>
					</div>
					@endif
				 	<!-- 授業レピュー -->
				 	@if(!$data['wrote_review'])
				 	<a href="/classes/review/{{ $data['detail']->class_id }}"><button class="btn btn-primary">この授業をレビューする！</button></a>
				 	@endif
				 	<a href="{{ $data['actual_syllabus_url'] }}" target="_blank"><button class="btn btn-info">公式シラバスを見る</button></a>
			 	</div>
				<div id="tab2" class="tab-contents">
					<div class="col6">
						<h3>投票方法</h3><hr>
						<p>この授業を履修したことのある方は、右の☆をクリックして、投票しよう！</p>
						<p>投票はレビューでもできます！</p>
					</div>
					<div class="col6">
						<table class="table table-bordered" style="margin: 20px auto; text-align: center;">
							<tbody>
							    <tr>
							      	<th>総合評価度</th>
							      	<td class="raty_stars"></td>
							    </tr>
							    <tr>
							    	<th>単位の取りやすさ</th>
							    	<td class="raty_unit_stars"></td>
							    </tr>
						      	<tr>
						      		<th>GP(成績)の取りやすさ</th>
						        	<td class="raty_grade_stars"></td>
						      	</tr>
					   		</tbody>
						</table>
						<button class="btn btn-info">投票する！</button>
					</div>
					<div class="bar_graph">
						<h3>平常点評価</h3><hr>
						<h4>出席</h4>
					</div>
					@if(!$data['wrote_review'])
					<a href="/classes/review/{{ $data['detail']->class_id }}"><button class="btn btn-primary">この授業をレビューする！</button></a>
					@endif
				</div>
				@if(!$data['review']->count())
				<div id="tab3" class="tab-contents">
					<div class="alert a-is-danger alert-removed fade in" style="margin: 20px auto;">
						この授業はまだレビューされていません。
					</div>
					<a href="/classes/review/{{ $data['detail']->class_id }}"><button class="btn btn-primary">この授業をレビューする！</button></a>
				</div>
				@else
				<div id="tab3" class="tab-contents">
				<p style="font-size:15px; color:red;">レビューの書き直しはマイページからできます</p>
					<table class="table table-bordered" style="margin: 20px auto;">
						<thead>
							<tr>
							<th>投稿者</th>
<!-- 							<th>総合評価度</th> -->
							<th>レビュー</th>
							</tr>
						</thead>
						<tbody>
			      @foreach($data['review'] as $r)
			    	<tr>
			    		<td>
			    			<img src="{{ isset($r->users()->first()->avatar)? $r->users()->first()->avatar:asset('/image/dummy.png') }}" width="70"height="70"><br />
			    			{{ isset($r->users()->first()->name)? $r->users()->first()->name:"不明なユーザ" }}
			    		</td>
<!-- 		         	<td>{{{ $r->stars }}}</td> -->
		         	<td>{{{ $r->review_comment }}}</td>
		 				</tr>
			      @endforeach
						</tbody>
					</table>
					@if(!$data['wrote_review'])
					<a href="/classes/review/{{ $data['detail']->class_id }}"><button class="btn btn-primary">この授業をレビューする！</button></a>
					@endif
				</div>
				@endif
			</div>
		</div>
		<a href="/search"><button class="btn btn-sm btn-default" style="margin-bottom: 20px;">検索結果に戻る</button></a>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('/js/d3.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/pie_graph.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/bar_graph.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/raty_lib/jquery.raty.js') }}"></script>
	<script type="text/javascript">

		//グラフデータ
			//var attendance_data = <?php echo $data['attendance_pie']; ?>,
				// final_evaluation_data = <?php echo $data['final_evaluation_pie']; ?>,
				// 円グラフ用JS
				evaluation_data = <?php echo $data['evaluation']; ?>;

			//テスト用
			var w = new pieClass("#eval_pie");

			//初回読み込み
		    w.render(evaluation_data);
		    w.update();
		    w.animate(evaluation_data); 

			// 初期化
			//タブ変更してからレンダー
			// $('.tab-index a').click(function(){
			//   if($(this).attr("href") == "#tab2"){

			//   }
			// });
			
	</script>
	<script type="text/javascript">
		var class_id = <?php echo $data['detail']->class_id; ?>;
	</script>
	<script type="text/javascript" src="{{ asset('/js/classes.js') }}"></script>
@stop
