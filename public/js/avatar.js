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
  //replaceWithだと2回目のアップが#file_inputに引っかからない。。
  //val("")で消す方式は、IE10だと消えないらしい。
  //床キャン生はMacなのでほぼIEを使わないのでしょう。。
  $("#reset_avatar").click(function(){
    $("#file_input").val("");
    $(".thumbnail_avatar").attr("src","/image/dummy.png");
     alertify.success("画像をリセットしました。")
  });

});