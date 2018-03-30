
jQuery(document).ready(function() {

	//cufon and font-face settings	
	
	var $form_custom_font = jQuery('[name=form-font_custom]');
		
		if($form_custom_font.val() == 'font-face'){
			//display font-face settings
			jQuery('.font-face-settings').css('display','none');
			jQuery('.font-face-settings').css('display','table-row');
			
		}else{
			jQuery('.font-face-settings').css('display','none');
		}
	
	
	$form_custom_font.change(function(){
		if(jQuery(this).val() == 'font-face'){
			//display font-face settings
			jQuery('.font-face-settings').css('display','none');
			jQuery('.font-face-settings').css('display','table-row');
			
		}else{
			jQuery('.font-face-settings').css('display','none');
		}
	});
	
});