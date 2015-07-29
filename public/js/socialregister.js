$(function(){

  //画像アップしたらサムネ表示
  $("#file_input").change(function(){
    var file = this.files[0];
    if(file != null){
      var fr = new FileReader();
        fr.onload = function() {
            $('.thumbnail_avatar').attr('src', fr.result ).css('display','inline');
        }
        fr.readAsDataURL(file);
        alertify.success("サムネイルを確認してください。<br>大きさは大丈夫そうですか？");
    }
  });
  //デフォルト画像
  $("#reset_avatar_button").on("click",function(){
    $("input[name='avatar']").val("").css("display","none");
    //$("input[name='avatar_url']").val("");
    $(".thumbnail_avatar").attr("src","/image/dummy.png");
  });

  //写真をアップロードする
  $("#photo_button").on("click",function(){
    //$("input[name='avatar_url']").val("");
    $("input[name='avatar']").css("display","block");
    $(".thumbnail_avatar").attr("src","/image/dummy.png");


  });

  //SNSの画像を使う
  $("#sns_button").on("click",function(){
    //$("input[name='avatar_url']").attr("value",avatar_url);
    $("input[name='avatar']").val("").css("display","none");

    $(".thumbnail_avatar").attr("src",avatar_url);
   });

  if(message !== undefined && message){
    alertify.success(message);
  }
});