jQuery(function ($) {

    //レビューの総合星
    $(".reviewer-stars").raty({
        score:function(){
            return $(this).attr('data-star');
        },
        readOnly:true
    });

    // getAverageStar([APIのURL], [星を表示したいhtml上のid]);
    // 平均値を取得し、星を表示する
    getAverageStar('stars-average', '.raty_stars_average');
    getAverageStar('credit-average', '.raty_credit_average');
    getAverageStar('grade-average', '.raty_grade_average');

	$('#add-new-tag').click(function(){
		$('.new-tag-field').fadeIn("slow");
	});

	//新しくタグを追加する！
	$('#add-tag-button').click(function(){
		//タグ名取得
		var tag_name = $('#add-tag-filed').val();
		var params = {
				"class_id":class_id,
				"tag_name":tag_name,
				"_token":$('meta[name="csrf-token"]').attr('content')
			};
            $.ajax({
                type: "POST",
                url: "../../tag/new",
                dataType: "Json",
                data: params,
                crossDomain:false,
                success: function(data, dataType)
                {
                    if(data["success"] === false){
                        alertify.error(data["message"]);
                        return null;
                    }
                    var new_tag = '<span class="btn-label info"><input class="delete-tag-button" type="submit" value="×" style="color: black;"><a href="" style="color: white; font-size: 1.5em;">#'+tag_name+'</a></span>';

                    $("#tag-list").append(new_tag).hide().fadeIn("slow");
                    alertify.success(data["message"]);

                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alertify.error('Error : ' + errorThrown);
                }
            });
	});
    // 履修済登録する!
    $('#add_register').click(function(){
        var params = {
            "class_id": class_id,
            "user_id": user_id,
            "_token":$('meta[name="csrf-token"]').attr('content')
        };
        $.ajax({
            type: "POST",
            url: "../../register/new",
            dataType: "Json",
            data: params,
            crossDomain: false,
            success: function(data, dataType)
            {
                if(data["success"] === false){
                    alertify.error(data["message"]);
                    return null;
                }
                alertify.success(data["message"]);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                alertify.error('Error : ' + errorThrown.message);
            }
        });

    });

	//タグ削除
	$("#tag-list").on("click",".delete-tag-button",function(){
		//対象となるタグ
		var target_tag = $(this);
		//タグ名取得
		var tag_name =  $(this).siblings().text();
		//#を削除
		tag_name = tag_name.replace("#","");

		var params = {
				"class_id":class_id,
				"tag_name":tag_name,
				"_token":$('meta[name="csrf-token"]').attr('content')
			};
            $.ajax({
                type: "POST",
                url: "../../tag/delete",
                dataType: "Json",
                data: params,
                crossDomain:false,
                success: function(data, dataType)
                {
                    if(data["success"] === false){
                        alertify.error(data["message"]);
                        return null;
                    }
                    target_tag.parent().fadeOut("slow",function(){
                        $(this).remove();
                    });
                    alertify.success(data["message"]);

                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alertify.error('Error : ' + errorThrown);
                }
            });
	});

    //ajax投稿
    $(".review-submit-button").on("click",function(){

        var params = {
                "stars"         : $('input[name=stars]').val(),
                "grade_stars"   : $('input[name=grade_stars]').val(),
                "unit_stars"    : $('input[name=unit_stars]').val(),
                "fulfill_stars"    : $('input[name=fulfill_stars]').val(),
                "attendance"    : $('input[name=attendance]:checked').val(),
                "grade"         : $('select[name=grade]').val(), 
                "bring"         : $('input[name=bring]:checked').val(),
                "review_comment" : $('textarea[name=review_comment]').val(),
                "class_id"      : $('input[name=class_id]').val(),
                "_token"        :$('meta[name="csrf-token"]').attr('content')
        }
        $.ajax({
            type: "POST",
            url: "../ajax-review",
            dataType: "Json",
            data: params,
            crossDomain:false,
            success: function(data, dataType)
            {
                //DB登録失敗
                if(data["success"] === false){
                    alertify.error(data["message"]);
                    return null;
                }
                //レビューフォームフェードアウト
                $('#review-form').fadeOut("slow",function(){
                    //そもそもエレメント削除
                    $(this).remove();
                    //トップへスクロール
                    $("html,body").animate({scrollTop:$('#tab2').offset().top});
                    //ダミーアバターを設置
                    if(data["avatar"] == null){
                        data["avatar"] = "/image/dummy.png";
                    }

                    //追加アニメーション
                    var reviewObj;
                    if($('.no-review').length === 0){
                    //レビューがある
                        //reviewObj = '<div class="panel panel-primary section-margin"><div class="panel-title review-panel-title"><div class="row-fluid"><div class="col8"><img src="'+data["avatar"]+'" width="70"height="70" alt="reviewer_avatar" style="vertical-align:top;"><div class="reviewer-info"><p style="margin-top:3%;">'+data["name"]+'</p><p>総合 <span class="reviewer-stars" data-star="'+params["stars"]+'"></span></p></div></div></div></div><div class="panel-body">'+params['review_comment']+'</div></div>';
                        $('#review-list').load('./'+class_id +' #review-list',function(){
                            $.getScript("/js/classes.js");
                        });
                        //$('#review-list').prepend(reviewObj).trigger("create");
                    }else{
                    //レビューがない
                        $('.no-review').fadeOut("fast",function(){
                            //reviewObj = '<div class="panel panel-primary section-margin"><div class="panel-title review-panel-title"><div class="row-fluid"><div class="col8"><img src="'+data["avatar"]+'" width="70"height="70" alt="reviewer_avatar" style="vertical-align:top;"><div class="reviewer-info"><p style="margin-top:3%;">'+data["name"]+'</p><p>総合 <span class="reviewer-stars" data-star="'+params["stars"]+'"></span></p></div></div></div></div><div class="panel-body">'+params['review_comment']+'</div></div>';
                            $('#tab2').load('./'+class_id+' #review-list',function(){
                                 $.getScript("/js/classes.js");
                            });
                            //location.reload(true);
                            //$('#tab2').prepend(reviewObj).trigger("create");
                        });
                    }
                });

                alertify.success(data["message"]);

            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                var errors;
                var res = XMLHttpRequest.responseJSON;
                for(var name in res){
                    //エラーフィールドに出す場合
                    //var field = $('#validation-error-field');
                    //field.fadeIn();
                    //field.children("ul").children("li")remove();
                    //field.children("ul").append("<li>").attr("style","color:red;").append(res[name][0]);

                    alertify.error(res[name][0]);
                }
            } 
        });
    });


    function getAverageStar(url, html_class){
        $.ajax({
            type: "GET",
            url: "../../classes/" + url + "/" + class_id,
            crossDomain:false,
            success: function(data, dataType){
                $(html_class).raty().raty('score', data).raty('readOnly', true);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                $(html_class).raty().raty('readOnly', true);
            }
        });
    }

    $('.tab-index a').click(function(e){
        $('.tab-index .active').removeClass('active');
        $(this).parent().addClass('active');
        $('.tab-contents').each(function(){
            $(this).removeClass('active');
        });
        $(this.hash).addClass('active');

        e.preventDefault();
    });

    //投票
  // 評価を星で表しています
  $(".raty_stars").raty('set', { 
    scoreName: 'stars', 
    score : function(){
      return $(this).attr('data-number');
    } 
  });
  $(".raty_unit_stars").raty('set', { 
    scoreName: 'unit_stars',
    score : function(){
      return $(this).attr('data-number');
    } 
  });
  $(".raty_grade_stars").raty('set', { 
    scoreName: 'grade_stars',
    score : function(){
      return $(this).attr('data-number');
    } 
  }); 
  $(".raty_fulfill_stars").raty('set', { 
    scoreName: 'fulfill_stars',
    score : function(){
      return $(this).attr('data-number');
    }  
  });
});