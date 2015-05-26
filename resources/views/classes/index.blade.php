@extends('master')

@section('title')
授業詳細 | {{ $data['detail']['class_name'] }}
@stop

@section('main_content')
<div class ="container">
	<div class ="row">
		<h1><?php echo $data['detail']->class_name?></h1>

		<div class="col-md-12">
			<div style="margin-buttom:20px;">
				<h2 class="page-header">授業詳細</h2>
				<hr>
				<h2>担当講師 | <?php echo $data['detail']->teacher?></h2>
				<h3>学期 | <?php echo $data['detail']->term == 0? '春学期':'秋学期'?></h3>
				<h3>曜日 | <?php echo $data['detail']->class_week?></h3>
				<h3>時限 | <?php echo $data['detail']->class_period?>限</h3>
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
			                    <form action="/classes/deleteconfirm" method="POST">
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
		
	</div>
</div>
@stop