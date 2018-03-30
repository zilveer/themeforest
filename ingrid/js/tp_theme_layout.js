jQuery(document).ready(function() {

	//color picker	
	
	jQuery('#colorpicker1').farbtastic('#color1');
	

	jQuery('.colorpicker').css('display','none');	

	var show_cp1 = '0';
	
	jQuery('.button').click(
		function(){
			//hide all cp on page
			jQuery('.colorpicker').css('display','none');
			
			
			if(show_cp1 == '0'){
				jQuery(this).next().css('display','inline');		
				show_cp1 = '1';
			}else{
				jQuery(this).next().css('display','none');		
				show_cp1 = '0';
			}
		}
	)	

	
	jQuery('.colorwell').click(function(){
		//hide all cp on page
		jQuery('.colorpicker').css('display','none');
	
		jQuery(this).next().next().css('display','inline');	
		show_cp1 = '1';
	});
	
	
	
	
	
	
	
	//show upload option for background
	jQuery('.opt-custom-1,.opt-custom-2').css('display','none');
	
	
	if( jQuery('[name=form-bg_home] option:selected').val() == 'custom' ){
		jQuery('.opt-custom-1').css('display','table-row');
	}
	
	jQuery('[name=form-bg_home]').change(function(){
		if( jQuery('[name=form-bg_home] option:selected').val() == 'custom' ){
			jQuery('.opt-custom-1').css('display','table-row');
		}else{
			jQuery('.opt-custom-1').css('display','none');
		}
	});
	
	
	//show upload option for background
	if( jQuery('[name=form-bg_subpages] option:selected').val() == 'custom' ){
		jQuery('.opt-custom-2').css('display','table-row');
	}
	
	jQuery('[name=form-bg_subpages]').change(function(){
		if( jQuery('[name=form-bg_subpages] option:selected').val() == 'custom' ){
			jQuery('.opt-custom-2').css('display','table-row');
		}else{
			jQuery('.opt-custom-2').css('display','none');
		}
	});
	
	
	

	
});