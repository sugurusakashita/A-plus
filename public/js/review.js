jQuery(function ($) {
	var current_type = $('[name=final_evaluation]').val();

	if(current_type == "期末試験"){
		$('.bring').css('display','table-cell');
	}

	$('[name=final_evaluation]').change(function(){
		var type = $(this).val();
		if(type == "期末試験"){
			$('.bring').fadeIn('normal');
		}else{
			$('.bring').fadeOut('normal');
		}
	});

	// 授業の感想が空欄ならsubmitさせない
	$('button[type=submit]').click(function(){
		var review_comment = $('textarea').val();

		if(review_comment.length == 0){
			// alertの表示
			alertify.error('授業の感想を入力してください');

			// 投稿を中止する
			return false;
		}
	});

});