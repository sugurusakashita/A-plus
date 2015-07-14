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

});