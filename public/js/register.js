$(function(){

  //画像アップしたらサムネ表示
  $("#file_input").on("change",function(){
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
  //アップロードキャンセル
  $("#reset_avatar").click(function(){
    $("#file_input").replaceWith($('#file_input').clone());
    $(".thumbnail_avatar").attr("src","/image/dummy.png");
     alertify.success("画像をリセットしました。")
  });

});