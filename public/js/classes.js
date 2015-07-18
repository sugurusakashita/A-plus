jQuery(function ($) {
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
                	alert(data["message"]);
                    if(data["success"] === false){
                    	return null;
                    }
                    var new_tag = '<span class="btn-label info"><input class="delete-tag-button" type="submit" value="×" style="color: black;"><a href="" style="color: white; font-size: 1.5em;">#'+tag_name+'</a></span>';

                    $("#tag-list").append(new_tag).hide().fadeIn("slow");

                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error : ' + errorThrown);
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
                	alert(data["message"]);
                    if(data["success"] === false){
                    	return null;
                    }
                    target_tag.parent().fadeOut("slow",function(){
                    	$(this).remove();
                    });

                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error : ' + errorThrown);
                }
            });
	});
	//タグ削除
 // 	$('.delete-tag-button').click(function(){
	// 	//対象となるタグ
	// 	var target_tag = $(this);
	// 	//タグ名取得
	// 	var tag_name =  $(this).siblings().text();
	// 	//#を削除
	// 	tag_name = tag_name.replace("#","");

	// 	var params = {
	// 			"class_id":class_id,
	// 			"tag_name":tag_name,
	// 			"_token":$('meta[name="csrf-token"]').attr('content')
	// 		};
 //            $.ajax({
 //                type: "POST",
 //                url: "../../tag/delete",
 //                dataType: "Json",
 //                data: params,
 //                success: function(data, dataType)
 //                {
 //                	alert(data["message"]);
 //                    if(data["success"] === false){
 //                    	return null;
 //                    }
 //                    target_tag.parent().fadeOut("slow",function(){
 //                    	$(this).remove();
 //                    });

 //                },
 //                error: function(XMLHttpRequest, textStatus, errorThrown)
 //                {
 //                    alert('Error : ' + errorThrown);
 //                }
 //            });
	// });


});