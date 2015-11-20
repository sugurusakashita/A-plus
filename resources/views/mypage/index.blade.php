@extends("full")

@section("title")
マイページ | A+plus
@stop

@section("css")

@stop

@section("meta")
<meta name="robots" content="noindex,nofollow">
@endsection

@section("main_content")
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<p>
			入力の一部に誤りがあります。</p><br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<!-- <div class="alert a-is-info">
		My Page
	</div> -->
	<div class="mypage">
		<div class="modal-content">
			<div class="panel panel-primary">
				<div class="panel-title">履修済登録</div>
				<div class="panel-body">
					<p style="margin-bottom: 10px;">履修済み登録から削除します。よろしいですか？</p>
					<button class="btn btn-danger" id="register-delete">はい</button>
					<button class="btn btn-primary" id="modal-close">いいえ</button>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-warning section-margin">
		<div class="panel-title">
			<div class="row-fluid">
				<div class="col1">
					My時間割
				</div>
				<div class="col1">
					<select id="year" name="year">
						@foreach ($years as $year)
							<option value="{{ $year->year }}">{{ $year->year }}年度</option>
						@endforeach
					</select>
				</div>
				<div class="col10">
					<select id="term" name="term">
						@foreach ($terms as $term)
							@if ($term->term != "通年")
								<option value="{{ $term->term }}"><?php echo $term->term == "春学期" || $term->term == "夏期集中" || $term->term == "集中講義（春学期）" || $term->term == "春季集中" || $term->term == "夏季集中"? "春学期・夏期集中":"秋学期・冬期集中"; ?></option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-bordered mypage-table">
				<thead>
					<th></th>
					<th>月</th>
					<th>火</th>
					<th>水</th>
					<th>木</th>
					<th>金</th>
					<th>土</th> <!-- 土はあるかないかで表示非表示 -->
				</thead>
				<tr>
					<td>1</td>
					<td data-week="月" data-period=1>
						{{ $time_table["月"][1]->class_name or "" }}<br>
						{{ $time_table["月"][1]->room_name or "" }}
					</td>
					<td data-week="火" data-period=1>
						{{ $time_table["火"][1]->class_name or "" }}<br>
						{{ $time_table["火"][1]->room_name or "" }}
					</td>
					<td data-week="水" data-period=1>
						{{ $time_table["水"][1]->class_name or "" }}<br>
						{{ $time_table["水"][1]->room_name or "" }}
					</td>
					<td data-week="木" data-period=1>
						{{ $time_table["木"][1]->class_name or "" }}<br>
						{{ $time_table["木"][1]->room_name or "" }}
					</td>
					<td data-week="金" data-period=1>
						{{ $time_table["金"][1]->class_name or "" }}<br>
						{{ $time_table["金"][1]->room_name or "" }}
					</td>
					<td data-week="土" data-period=1>
						{{ $time_table["土"][1]->class_name or "" }}<br>
						{{ $time_table["土"][1]->room_name or "" }}
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td data-week="月" data-period=2>
						{{ $time_table["月"][2]->class_name or "" }}<br>
						{{ $time_table["月"][2]->room_name or "" }}
					</td>
					<td data-week="火" data-period=2>
						{{ $time_table["火"][2]->class_name or "" }}<br>
						{{ $time_table["火"][2]->room_name or "" }}
					</td>
					<td data-week="水" data-period=2>
						{{ $time_table["水"][2]->class_name or "" }}<br>
						{{ $time_table["水"][2]->room_name or "" }}
					</td>
					<td data-week="木" data-period=2>
						{{ $time_table["木"][2]->class_name or "" }}<br>
						{{ $time_table["木"][2]->room_name or "" }}
					</td>
					<td data-week="金" data-period=2>
						{{ $time_table["金"][2]->class_name or "" }}<br>
						{{ $time_table["金"][2]->room_name or "" }}
					</td>
					<td data-week="土" data-period=2>
						{{ $time_table["土"][2]->class_name or "" }}<br>
						{{ $time_table["土"][2]->room_name or "" }}
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td data-week="月" data-period=3>
						{{ $time_table["月"][3]->class_name or "" }}<br>
						{{ $time_table["月"][3]->room_name or "" }}
					</td>
					<td data-week="火" data-period=3>
						{{ $time_table["火"][3]->class_name or "" }}<br>
						{{ $time_table["火"][3]->room_name or "" }}
					</td>
					<td data-week="水" data-period=3>
						{{ $time_table["水"][3]->class_name or "" }}<br>
						{{ $time_table["水"][3]->room_name or "" }}
					</td>
					<td data-week="木" data-period=3>
						{{ $time_table["木"][3]->class_name or "" }}<br>
						{{ $time_table["木"][3]->room_name or "" }}
					</td>
					<td data-week="金" data-period=3>
						{{ $time_table["金"][3]->class_name or "" }}<br>
						{{ $time_table["金"][3]->room_name or "" }}
					</td>
					<td data-week="土" data-period=3>
						{{ $time_table["土"][3]->class_name or "" }}<br>
						{{ $time_table["土"][3]->room_name or "" }}
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td data-week="月" data-period=4>
						{{ $time_table["月"][4]->class_name or "" }}<br>
						{{ $time_table["月"][4]->room_name or "" }}
					</td>
					<td data-week="火" data-period=4>
						{{ $time_table["火"][4]->class_name or "" }}<br>
						{{ $time_table["火"][4]->room_name or "" }}
					</td>
					<td data-week="水" data-period=4>
						{{ $time_table["水"][4]->class_name or "" }}<br>
						{{ $time_table["水"][4]->room_name or "" }}
					</td>
					<td data-week="木" data-period=4>
						{{ $time_table["木"][4]->class_name or "" }}<br>
						{{ $time_table["木"][4]->room_name or "" }}
					</td>
					<td data-week="金" data-period=4>
						{{ $time_table["金"][4]->class_name or "" }}<br>
						{{ $time_table["金"][4]->room_name or "" }}
					</td>
					<td data-week="土" data-period=4>
						{{ $time_table["土"][4]->class_name or "" }}<br>
						{{ $time_table["土"][4]->room_name or "" }}
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td data-week="月" data-period=5>
						{{ $time_table["月"][5]->class_name or "" }}<br>
						{{ $time_table["月"][5]->room_name or "" }}
					</td>
					<td data-week="火" data-period=5>
						{{ $time_table["火"][5]->class_name or "" }}<br>
						{{ $time_table["火"][5]->room_name or "" }}
					</td>
					<td data-week="水" data-period=5>
						{{ $time_table["水"][5]->class_name or "" }}<br>
						{{ $time_table["水"][5]->room_name or "" }}
					</td>
					<td data-week="木" data-period=5>
						{{ $time_table["木"][5]->class_name or "" }}<br>
						{{ $time_table["木"][5]->room_name or "" }}
					</td>
					<td data-week="金" data-period=5>
						{{ $time_table["金"][5]->class_name or "" }}<br>
						{{ $time_table["金"][5]->room_name or "" }}
					</td>
					<td data-week="土" data-period=5>
						{{ $time_table["土"][5]->class_name or "" }}<br>
						{{ $time_table["土"][5]->room_name or "" }}
					</td>
				</tr>
				<tr>
					<td>6</td>
					<td data-week="月" data-period=6>
						{{ $time_table["月"][6]->class_name or "" }}<br>
						{{ $time_table["月"][6]->room_name or "" }}
					</td>
					<td data-week="火" data-period=6>
						{{ $time_table["火"][6]->class_name or "" }}<br>
						{{ $time_table["火"][6]->room_name or "" }}
					</td>
					<td data-week="水" data-period=6>
						{{ $time_table["水"][6]->class_name or "" }}<br>
						{{ $time_table["水"][6]->room_name or "" }}
					</td>
					<td data-week="木" data-period=6>
						{{ $time_table["木"][6]->class_name or "" }}<br>
						{{ $time_table["木"][6]->room_name or "" }}
					</td>
					<td data-week="金" data-period=6>
						{{ $time_table["金"][6]->class_name or "" }}<br>
						{{ $time_table["金"][6]->room_name or "" }}
					</td>
					<td data-week="土" data-period=6>
						{{ $time_table["土"][6]->class_name or "" }}<br>
						{{ $time_table["土"][6]->room_name or "" }}
					</td>
				</tr>
				<!-- <tr>
					<td>7</td>
					<td data-week="月" data-period=7>
					</td>
					<td data-week="火" data-period=7>
					</td>
					<td data-week="水" data-period=7>
					</td>
					<td data-week="木" data-period=7>
					</td>
					<td data-week="金" data-period=7>
					</td>
					<td data-week="土" data-period=7>
					</td>
				</tr> -->
			</table>
			<p>※履修済授業リストに追加されている授業のデータを基に時間割を作成しています。</p>
		</div>
	</div>
	<div class="panel panel-success section-margin">
		<div class="panel-title">履修済授業リスト</div>
		<div class="panel-body" style="over-flow-x:auto;">
			@if($class_list)
				<p style="margin-bottom: 10px;">※曜日、時限、教室が空白の場合、時間割にはその授業の内容は反映されません。</p>
				<table class="table table-bordered mypage-table section-margin">
					<thead>
						<!-- <th style="width: 50px;"></th> -->
						<th>学部</th>
						<th style="width:100px;">受講年度</th>
						<th>授業名</th>
						<th>曜日</th>
						<th>限</th>
						<th>教室</th>
						<th>カテゴリ</th>
						<th>削除</th>
					</thead>
					<tbody>
						@for($i = 0; $i < count($class_list); $i++)
						<form class="retgister-delete" action="#" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<tr id="row-{{ $i }}">
								<td style="width:100px;">{{ $class_list[$i]['class_registered']->faculty }}</td>
								<td style="width:60px;">{{ $class_list[$i]['class_registered']->year }}</td>
								<td style="width:450px;">{{ $class_list[$i]['class_registered']->class_name }}</td>
								<td style="width:60px;">
									@if(count($class_list[$i]['class_registered_detail']) > 1)
										@for($j = 0; $j < count($class_list[$i]['class_registered_detail']); $j++)
											@if($j < count($class_list[$i]['class_registered_detail'])-1 )
												{{ $class_list[$i]['class_registered_detail'][$j]->class_week }}/
											@else
												{{ $class_list[$i]['class_registered_detail'][$j]->class_week }}
											@endif
										@endfor
									@else
										@foreach($class_list[$i]['class_registered_detail'] as $detail)
											{{ $detail->class_week }}
										@endforeach
									@endif
								</td>
								<td style="width:60px;">
									@if(count($class_list[$i]['class_registered_detail']) > 1)
										@for($j = 0; $j < count($class_list[$i]['class_registered_detail']); $j++)
											@if($j < count($class_list[$i]['class_registered_detail'])-1 )
												{{ $class_list[$i]['class_registered_detail'][$j]->class_period }}/
											@else
												{{ $class_list[$i]['class_registered_detail'][$j]->class_period }}
											@endif
										@endfor
									@else
										@foreach($class_list[$i]['class_registered_detail'] as $detail)
											{{ $detail->class_period }}
										@endforeach
									@endif
								</td>
								<td style="width:120px;">
									@if(count($class_list[$i]['class_registered_detail']) > 1)
										@for($j = 0; $j < count($class_list[$i]['class_registered_detail']); $j++)
											@if($j < count($class_list[$i]['class_registered_detail'])-1 )
												{{ $class_list[$i]['class_registered_detail'][$j]->room_name }}/
											@else
												{{ $class_list[$i]['class_registered_detail'][$j]->room_name }}
											@endif
										@endfor
									@else
										@foreach($class_list[$i]['class_registered_detail'] as $detail)
											{{ $detail->room_name }}
										@endforeach
									@endif
								</td>
								<td style="width:120px;">{{ $class_list[$i]['class_registered']->category }}</td>
								<td style="width: 60px;"><button style="font-size: 90%;" id="register-delete-confirm" class="btn btn-sm btn-danger btn-xs">削除</button></td>
							</tr>
						@endfor
					</tbody>
				</table>
			@else
				<p><strong>登録されている授業がありません。履修した授業を検索して履修済登録しましょう！</strong></p>
			@endif
		</div>
	</div>

	<div class="panel panel-primary section-margin">
		<div class="panel-title">
			<div class="row-fluid">
				<div class="col4">レビュー履歴</div>
				<div class="col8">合計レビュー件数: <span style="color:#F35D5D;">{{ $reviews->count() }}件</span></div>
			</div>
		</div>
		<div class="panel-body">
			@if(!$reviews->count())
				<p style="color:#FF0000;">まだレビューされていません。</p>
			@else
			@foreach($reviews as $review)
			<div class="panel panel-default">
				<div class="panel-title">
					<div class="row-fluid">
						<div class="col9" style="font-size:1.3em">
							<a href="/classes/index/{{ $review->classes()->first()->class_id }}">{{ $review->classes()->first()->class_name }}</a>
							<form action="/mypage/edit" method="get" class="review-edit-delete">
									<input type="hidden" value="{{{ $review->review_id }}}" name="review_id">
									<input type="hidden" name="_token" value="{{csrf_token()}}" />
									<button type="submit" class="btn btn-success btn-sm" >編集</button>
						    </form>
					        <form action="/mypage/delete-confirm" method="POST" class="review-edit-delete">
					          	<input type="hidden" value="{{{ $review->review_id }}}" name="review_id">
					          	<input type="hidden" name="_token" value="{{csrf_token()}}" />
					          	<button type="submit" class="btn btn-danger btn-sm">削除</button>
					        </form>
						</div>
						<div class="col3">
							更新日時:{{ $review->updated_at }}

						</div>
					</div>
				</div>
				<div class="panel-title">
					<div class="row-fluid">
						<div class="col3">
						総合<span class="raty_stars" data-star="{{ $review->stars }}"></span>
						</div>
						<div class="col3">
						単位の取りやすさ<span class="raty_stars" data-star="{{ $review->unit_stars }}"></span>
						</div>
						<div class="col3">
						GP(成績)の取りやすさ<span class="raty_stars" data-star="{{ $review->grade_stars }}"></span>
						</div>
						<div class="col3">
						内容の充実度<span class="raty_stars" data-star="{{ $review->fulfill_stars }}"></span>
						</div>
					</div>
				</div>
				<div class="panel-body">
					{{ mb_strimwidth($review->review_comment,0,100,"...") }}
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>

	<div class="panel panel-success">
		<div class="panel-title">登録情報</div>
		<div class="panel-body">プロフィールを変更するには「編集」ボタンをクリックしてください。
			<div class="section-margin row-fluid">
				<div class="col3">
					<div class="panel panel-info">
						<div class="panel-title">プロフィール画像</div>
						<div class="panel-body">
							<img class="profile-value" width="100" height="100" src="{{ $user->avatar? $user->avatar:asset("image/dummy.png") }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<a class="btn btn-sm btn-success btn-xs right-float" href="/mypage/avatar">編集</a>
						</div>
					</div>
				</div>
				<div class="col9">
					<div class="panel panel-info">
						<div class="panel-title">ユーザー名</div>
						<div class="panel-body">
							<form class="name" action="#" method="POST">
								<span class="profile-value">{{ $user->name }}</span>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid section-margin">
				<div class="col7">
					<div class="panel panel-warning">
						<div class="panel-title">登録メールアドレス</div>
						<div class="panel-body">
							<form class="email" action="#" method="POST">
							<span class="profile-value">{{ $user->email }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col5">
					<div class="panel panel-warning">
						<div class="panel-title">パスワード</div>
						<div class="panel-body">
							<span class="profile-value">**********</span>
						</div>
					</div>
				</div>
			</div>
			<div class="section-margin row-fluid">
				<div class="col4">
					<div class="panel panel-default">
						<div class="panel-title">性別</div>
						<div class="panel-body">
							<form class="sex" action="#" method="POST">
							<span class="profile-value">{{ $user->sex }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col4">
					<div class="panel panel-default">
						<div class="panel-title">入学年度</div>
						<div class="panel-body">
							<form class="entrance_year" action="#" method="POST">
							<span class="profile-value">{{ $user->entrance_year }}{{ $user->entrance_year == "その他"? "":"年度"  }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col4">
					<div class="panel panel-default">
						<div class="panel-title">学部</div>
						<div class="panel-body">
							<form class="faculty" action="#" method="POST">
							<span class="profile-value">{{ $user->faculty }}</span>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-sm btn-success btn-xs edit-button right-float">編集</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div id="password-notice" class="panel-body">
					パスワードの変更は、お手数ですが一度パスワードをリセットしてから再設定となります。<br />
					<a href="/password/email">こちらから登録されているアドレスにメールを送信して再設定してください。</a>
				</div>
			</div>
		</div>
	</div>
@stop

@section("js")
	<script type="text/javascript" >
		var message;
		<?php if(old("message")){ ?>
			message = <?php echo '"'.old("message").'"'; ?>;
		<?php } ?>

	</script>
	<script type="text/javascript" src="{{ asset("/js/mypage.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/raty_lib/jquery.raty.js") }}"></script>
@stop
