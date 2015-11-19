@extends('full')

@section('title')
プロフィール画像変更 | A+plus
@stop

@section('meta')
<meta name="robots" content="noindex,nofollow">
@endsection

@section('css')
<link  href="https://cdn.rawgit.com/fengyuanchen/cropper/v1.0.0/dist/cropper.min.css" rel="stylesheet">
@endsection

@section('main_content')
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
	<div class="panel panel-success">
		<div class="panel-title">
			プロフィール画像編集
		</div>
		<div class="panel-body">
		    <form class="form-horizontal" id="entry-form" role="form" method="POST" action="{{ url('/mypage/avatar') }}" enctype='multipart/form-data'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="file_input">プロフィール画像</label>
					<div class="row-fluid">
						<div class="col6">
							<img class="thumbnail_avatar" src="/image/meta/logo320.png" alt="dummy_image">
							<input type="hidden" value="0" name="orientation">
						</div>
						<div class="col6 section-margin">
							<input id="fileInput" type="file" name="avatar" class="form-element" accept="image/*" style="display:none;">
							<input type="hidden" name="croppedAvatar" value="">
							<div>
								<button type="button" class="btn btn-success" data-method="rotate" data-option="-90"><span class="icon-undo2 icons"></span></button>
								<button type="button" class="btn btn-success" data-method="rotate" data-option="90"><span class="icon-redo2 icons"></span></button>
							</div>
							<div class="section-margin">
								<label>プレビュー</label>
								<div class="half left-float">
								<div class="preview-avatar block-center" style="width:100px; height:100px; overflow:hidden; border:solid 1px;"></div>
								</div>
								<div class="half left-float">
									<div><input type="radio" name="radioAvatarType" value="0" checked>デフォルト画像を利用する</div>
									<div><input type="radio" name="radioAvatarType" value="1" >画像をアップロードして利用する</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-danger" style="margin-bottom: 15px;">
					<div class="panel-title">
					青い枠をドラッグして拡大縮小、枠内をドラッグで使用する領域を選択できます！(デフォルト画像以外)<br>
					画像ファイルはjpg,png,gifのみで、ファイルサイズは4MBまでです。<br>
					</div>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-md btn-primary register-button">
						更新する
					</button>
				</div>
			</form>
		</div>
	</div>
 
@stop
@section('js')
	<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v1.0.0/dist/cropper.min.js"></script>
	<script type="text/javascript" src="{{ asset('/js/exif.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/megapix-image.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/avatar.js') }}"></script>
	<script type="text/javascript">
      //アラートメッセージ用
      <?php

      if(old("alert")){
          echo "alertify.error('".old("alert")."');";
      }
      ?>
    </script>
@stop