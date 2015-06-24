@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('js')
<script type="text/javascript" src="/js/classes.js"></script>
@stop

@section('title')
授業詳細 | {{ $data['detail']['class_name'] }}
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
				 <p><?php echo $data['detail']->class_name?></p>
				</div>

				<!-- タグ作ってる -->
			 	@if($data['tag']['list'])
				 	<div style="padding: 10px;">
				 		@foreach($data['tag']['list'] as $t)
				 		<span class="btn-label info">
				 			<form action="#" method="POST" name="delete_tag" style="margin: 0;">
				 				<input type="submit" value="×" style="color: black;">
				 				<a href="" style="color: white; font-size: 1.5em;">#{{ $t->tag_name }}</a>
				 				<input type="hidden" value="{{ $t->tag_name }}" name="delete_tag_name">
				 				<input type="hidden" name="_token" value="{{csrf_token()}}" />
				 			</form>
			 			</span>
				 		@endforeach
				 	</div>
			 	@endif
				 	<div class="form-element-group">
						<input class="form-element" type="text" placeholder="ここに新しいタグを入力!"/>
						<span class="form-group-btn">
							<button class="btn btn-default" type="submit" name="add_button">追加</button>
						</span>
		 	    </div>


				 	<div class="add_tag">
				 		<a href="/tag/add/{{ $data['detail']->class_id }}"><p>リストからタグを追加する！</p></a>
				 		<p>ない場合は...
				 		<form action="#" method="POST" name="add_tag">
				 			<input type="text" size="32" placeholder="ここに新しいタグを入力!" required name="add_tag_name" value=""/>
				 			<input type="hidden" name="_token" value="{{csrf_token()}}" />
				 			<button type="submit" name="add_button">追加</button>
				 		</form>
				 		</p>
				 	</div>

			 	<!-- 授業レピュー -->
				<div>
					<div>
						<button class="btn btn-primary"><a href="/classes/review/{{ $data['detail']->class_id }}" style="color: white;">この授業をレビューする！</a></button>
						<?php if(!$data['review']->count()){ ?>
							<p style='color:#FF0000;'>この授業はまだレビューされていません。</p>
						<?php } else { ?>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
								<th>投稿者</th>
								<th>レビュー</th>
								<th>総合評価度</th>
								<th>単位の取りやすさ</th>
								<th>GP(成績)の取りやすさ</th>
								</tr>
							</thead>
						<tbody>
				      @foreach($data['review'] as $r)
				    	<tr>
				    		<td>ゲストユーザ</td>
				         	<td>{{{ $r->review_comment }}}</td>
				         	<td>{{{ $r->stars }}}</td>
				         	<td>{{{ $r->unit_stars }}}</td>
				         	<td>{{{ $r->grade_stars }}}</td>
				         	<td>
				          <!-- <a href="/classes/show/" class="btn btn-default btn-xs">詳細</a> -->
				          <form action="/classes/edit" method="get">
				          	<input type="hidden" value="{{{ $r->review_id }}}" name="review_id">
				          	<input type="hidden" name="_token" value="{{csrf_token()}}" />
				          	<button type="submit" class="btn btn-success btn-xs" />編集</button>
				          </form>
				          <form action="/classes/delete-confirm" method="POST">
				          	<input type="hidden" value="{{{ $r->review_id }}}" name="review_id">
				          	<input type="hidden" name="_token" value="{{csrf_token()}}" />
				          	<button type="submit" class="btn btn-danger btn-xs">削除</button>
				          </form>
				  				</td>
				 				</tr>
				      @endforeach
				      <?php }; ?>
							</tbody>
						</table>
					</div>
				</div>

			 	<!-- 授業要旨 -->
				@if($data['detail']->summary)
				<div class="panel panel-info">
				 <div class="panel-title">
				   授業要旨
				 </div>
				 <div class="panel-body">
				 	{{ $data['detail']->summary }}
				 </div>
				</div>
				@endif

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
			        			<a href="">{{ $teacher->teacher_name }}</a>
			        		@endforeach
			        	@endif
			        </th>
			        <td><?php echo $data['detail']->term == 0? '春学期':'秋学期'?></th>
			        <td><?php echo $data['detail']->class_week?></th>
			        <td><?php echo $data['detail']->class_period?>限</th>
			        <td>{{ $data['detail']->room_name }}</th>
			      </tr>
			    </tbody>
				</table>

			</div>
		</div>
		<a href="/search"><p>検索結果に戻る</p></a>
@stop