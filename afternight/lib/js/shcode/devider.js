

jQuery(document).ready(function() {
	
	/*reset inputs when page is reloaded*/
	jQuery('#typography_type option:first').prop('selected','selected');
	jQuery('#default_insert_btn_area').show();
	jQuery('#type_quote').hide();
	
	
	jQuery('#typography_type').change(function() {
			
		if(jQuery(this).val().indexOf('type_') != -1){
			jQuery('#default_insert_btn_area').hide();
			jQuery('.typography_more_settings').hide();
			jQuery('#'+jQuery(this).val()).show();
		}else{
			jQuery('.typography_more_settings').hide();
			jQuery('#default_insert_btn_area').show();
		}
		
	});
});

function insertSimple(){
	
	Editor.AddText( "content" , "\n"+jQuery('#typography_type').val()+"\n");
	showNotify();
	
}

