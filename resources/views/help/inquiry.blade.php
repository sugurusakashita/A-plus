@extends('master')

@section('sidebar')
@include('common.sidebar')
@stop

@section('title')
お問い合わせ | A+plus
@stop

@section('main_content')
<div>
  <h1>お問い合わせフォーム</h1>
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <p>
          入力の一部に誤りがあります。</p><br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li style="color:red;">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    <form action="/help/inquiry" method="POST">
      <div class="form-group">
        <label>カテゴリ</label>
        <select name="category" class="form-control" >
            <option value="">カテゴリを選択してください</option>
            <option {{ old("category") == "質問"? "selected":"" }}>質問</option>
            <option {{ old("category") == "苦情"? "selected":"" }}>苦情</option>
            <option {{ old("category") == "意見"? "selected":"" }}>意見</option>
            <option {{ old("category") == "バグレポート"? "selected":"" }}>バグレポート</option>
            <option {{ old("category") == "その他"? "selected":"" }}>その他</option>
        </select>
      </div>
      <div class="form-group">
        <label>Emailアドレス</label>
        <input placeholder="メールアドレスを入力してください。" type="text" size="30" name="email" class="form-control form-element" value="{{ old('email') }}">
      </div>
      <div class="form-group">
       <label>お問い合わせ内容</label>
       <textarea placeholder="こちらに内容を入力してください。" name="inquiry_text" rows="7" class="form-control form-element">{{ old('inquiry_text') }}</textarea>
      </div>
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="submit" class="btn btn-primary">送信する</button>
    </form>
</div>
@stop

