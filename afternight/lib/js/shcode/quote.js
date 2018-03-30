

jQuery(document).ready(function() {
	
	/*reset inputs when page is reloaded*/
	resetQuoteSettings();    
	
	jQuery('#quote_content').keyup(function() {
		
		if(jQuery.trim(jQuery(this).val()) != ''){
			jQuery('#quote_demo p').html(jQuery(this).val());
		}
		else{
			jQuery('#quote_demo p').html('Pellentesque risus diam vestibulum phasellus.');
		}
		
	});
	
	
	
	jQuery('#quote_style').change(function() {
		
		if(jQuery(this).val() == 'boxed'){
			jQuery('#quote_demo div').addClass('boxed');
		}else{
			jQuery('#quote_demo div').removeClass('boxed');
		}
		
	});
	
	jQuery('#quote_float').change(function() {
		
		if(jQuery(this).val() == 'none'){
			jQuery('#quote_demo div').removeClass('left');
			jQuery('#quote_demo div').removeClass('right');
			
		}else if(jQuery(this).val() == 'left'){
			jQuery('#quote_demo div').removeClass('right');
			jQuery('#quote_demo div').addClass('left');
		}
		else{
			jQuery('#quote_demo div').removeClass('left');
			jQuery('#quote_demo div').addClass('right');
		}
		
	});
});


function resetQuoteSettings(){
	jQuery('#quote_content').val('');
	jQuery('#quote_style option:first').prop('selected','selected');
	jQuery('#quote_float option:first').prop('selected','selected');    	
	jQuery('#quote_demo div').removeClass('left');
	jQuery('#quote_demo div').removeClass('right');
	jQuery('#quote_demo div').removeClass('boxed');
	jQuery('#quote_demo p').html('Pellentesque risus diam vestibulum phasellus.');
	
}

function insertQuote(){
	
	var quote_content = 'The content';
	var quote_style = '';
	var quote_float = '';
	
	if(jQuery('#quote_content').val() != ''){ 
		quote_content = jQuery('#quote_content').val();
	}
	
	if(jQuery('#quote_style').val() != 'none'){ 
		quote_style = 'style="'+ jQuery('#quote_style').val() +'"'; 
	}
	
	if(jQuery('#quote_float').val() != 'none'){ 
		quote_float = 'float="'+ jQuery('#quote_float').val() +'"'; 
	}
	
	var quote_shcode = '[quote '+quote_style+' '+quote_float+']'+quote_content+'[/quote]';
	
	Editor.AddText( "content" , "\n"+ quote_shcode +"\n");
	showNotify();
}