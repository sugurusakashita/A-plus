jQuery(function ($) {

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
});