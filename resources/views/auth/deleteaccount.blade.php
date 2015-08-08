@extends('full')

@section('title')
無料会員退会 | A+plus
@stop


@section('main_content')
<div id="content">
  <h1>A+plus 無料会員退会</h1><hr>
  <p style="color:red;">退会されると、今までのレビューなどのデータも全て削除されます。<br>利用に関しては無料なので、利用されない場合でも会員継続をお勧め致します。</p>
  <p>退会後はユーザー様の個人情報を削除いたします。<b>レビューやポイントの復元は一切できません。</b></p>
  <div class="delete-confirm">
    <form action="delete-account" method="POST">
      <p>退会されますか？</p>
      <button type="submit" class="btn btn-danger">退会する</a>  
      <input type="hidden" name="_token" value="{{ csrf_token() }}">       
    </form> 
  </div>

</div>
@stop

