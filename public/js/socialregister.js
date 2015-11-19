$(function(){
  var $image = $('.thumbnail_avatar');
    // Import image
    var $inputImage = $('#fileInput');
    var $radioType = $('input[name=radioAvatarType]');
    var URL = window.URL || window.webkitURL;

    $image.cropper({
      autoCropArea:1.0,
      aspectRatio: 1 / 1,
      checkImageOrigin:false,
      highlight: false,
      dragCrop: false,
      movable: false,
      zoomable: false,
      preview:".preview-avatar",
    });

    function resizeImage(file) {
        var d = new $.Deferred();
        var mpImg = new MegaPixImage(file);
        var src_keeper = document.getElementsByClassName("thumbnail_avatar")[0];
        EXIF.getData(file, function() {
            var orientation = file.exifdata.Orientation;
            $('input[name="orientation"]').val(orientation);
            var mpImg = new MegaPixImage(file);
            mpImg.render(src_keeper, {orientation: orientation }, function() {
                var resized_img = $(src_keeper).attr('src');
                d.resolve(resized_img,0);
            });
        });
        return d.promise();
    }

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
            resizeImage(file).then(function(img){
              $image.cropper('reset').cropper('replace', img);
            });
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
      $('.register-button').prop('disabled',true);
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

    if(message !== undefined && message){
      alertify.success(message);
    }
});