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
		@if($data['tag']['add_result']->added_tag)
			<p style="color:red;">タグが追加されました。</p>
		@endif
		@if($data['tag']['add_result']->deleted_tag)
			<p style="color:red;">タグが削除されました。</p>
		@endif

<!-- 		<div class="panel panel-default">
		 <div class="panel-body">
		 </div>
		</div>
 -->	<div class="col-md-12">
			<div style="margin: 0 auto 20px;">

				<div class="alert a-is-info" style="margin: 0 auto 20px;">
				 <p><?php echo $data['detail']->class_name?></p>
				</div>

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
			        		@foreach($data['teacher'] as $teacher_name)
			        			<a href="">{{ $teacher_name }}</a>
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
				<h3>タグ |
				@if($data['tag']['list'])
					@foreach($data['tag']['list'] as $t)
						<form action="#" method="POST" name="delete_tag">
							<input type="submit" value="×"> 
							<a href="">#{{ $t->tag_name }}</a>
							<input type="hidden" value="{{ $t->tag_name }}" name="delete_tag_name">
							<input type="hidden" name="_token" value="{{csrf_token()}}" />
						</form>
					@endforeach
				@endif
				</h3>
				<div class="add_tag">
					<a href="/tag/add/{{ $data['detail']->id }}"><p>リストからタグを追加する！</p></a><br>
					<p>ない場合は...</p>
					<form action="#" method="POST" name="add_tag">
						<input type="text" size="32" placeholder="ここに新しいタグを入力!" required name="add_tag_name" value=""/>
						<input type="hidden" name="_token" value="{{csrf_token()}}" />
						<button type="submit" name="add_button" >追加</button>
					</form>
				</div>
			</div>

			<div>
				<h2 class="page-header">授業レビュー</h2>
				<hr>
				<div>
			      	<table class="table table-striped table-hover">
			          	<thead>
				          	<tr>
				              <th>投稿者</th>
				              <th>レビュー</th>
				              <th>評価度</th>
				              <th>作成日時</th>
				              <th>更新日時</th>
				          	</tr>
			          	</thead>
			          	<tbody>
 <?php
					if(!$data['review']->count()){
						echo "<p style='color:#FF0000;'>この授業はまだレビューされていません。</p>";
					}else{
 ?>
          @foreach($data['review'] as $r)
			              	<tr>
			              		<td>ゲストユーザ</td>	
			                   	<td>{{{ $r->review_comment }}}</td>
			                   	<td>{{{ $r->stars }}}</td>
			                   	<td>{{{ $r->created_at }}}</td>
			                   	<td>{{{ $r->updated_at }}}</td>
			                   	<td>
			                    <!-- <a href="/classes/show/" class="btn btn-default btn-xs">詳細</a> -->
			                    <form action="/classes/edit" method="get">
			                    	<input type="hidden" value="{{{ $r->id }}}" name="review_id">
			                    	<input type="hidden" name="_token" value="{{csrf_token()}}" />
			                    	<button type="submit" class="btn btn-success btn-xs" />編集</button>
			                    </form>
			                    <form action="/classes/delete-confirm" method="POST">
			                    	<input type="hidden" value="{{{ $r->id }}}" name="review_id">
			                    	<input type="hidden" name="_token" value="{{csrf_token()}}" />
			                    	<button type="submit" class="btn btn-danger btn-xs">削除</button>
			                    </form>
                  				</td>
             				</tr>
          @endforeach
<?php
		}
?>
         				</tbody>
         			</table>
				</div>
			</div>
			<a href="/classes/review/{{ $data['detail']['id'] }}"><p>この授業をレビューする！</p></a>
		</div>
		<a href="/search"><p>検索に戻る</p></a>
@stop