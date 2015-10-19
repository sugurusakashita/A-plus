$(function(){
  var $image = $('.thumbnail_avatar');
    // Import image
    var $inputImage = $('#fileInput');
    var $radioType = $('input[name=radioAvatarType]');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    $image.cropper({
      autoCropArea:1.0,
      aspectRatio: 1 / 1,
      checkImageOrigin:false,
      highlight: false,
      dragCrop: false,
      movable: false,
      zoomable: false,
      preview:".preview-avatar",
    }).cropper('disable');

    if (URL) {
      $inputImage.on('change',function () {
        var files = this.files;
        var file;

        if (!$image.data('cropper')) {
          return;
        }

        if (files && files.length) {
          file = files[0];

          if (/^image\/\w+$/.test(file.type)) {
            blobURL = URL.createObjectURL(file);
            $image.one('built.cropper', function () {
              URL.revokeObjectURL(blobURL); // Revoke when load complete
            }).cropper('reset').cropper('replace', blobURL);
            // $inputImage.val('');
          } else {
            alertify.success("アップロードエラー");
          }
        }
      });
    } else {
      $inputImage.prop('disabled', true).parent().addClass('disabled');
    }


    //回転ボタン
    $('button[data-method="rotate"]').on('click',function(){
      var degree = $(this).data('option');
      $image.cropper('rotate',degree);
    });
    //クロップ情報
    $('#entry-form').submit(function(){
      var data = $image.cropper('getData');
      data = JSON.stringify(data);
      $('input[name=croppedAvatar]').val(data);
    });

    $('input[name=radioAvatarType]').on('change',function(e){
      switch($(this).val()){
        case "0":
          $image.cropper('reset').cropper('replace','/image/meta/logo320.png').cropper('disable');
          $inputImage.val('');
          break;
        case "1":
          $image.cropper('enable');
          $radioType.eq(1).prop('checked',false);
          $inputImage.val('').click();
          break;
        case "2":
          $image.cropper('enable');
          var avatar_url = $('input[name=avatar_url]').val();
          $image.cropper('reset').cropper('replace',avatar_url);
          $inputImage.val('');
          break;
      }
    });
    //ファイル変更リスナー
    $inputImage.change(function(){
      $radioType.eq(1).prop('checked',true);
    });

});