jQuery(document).ready(function() {
	
	resetButtons();
	
	jQuery('#btn_color').change(function() {
		jQuery('#btn_color option').each(function(index) {   
			jQuery('#preview_area button').removeClass(jQuery(this).val());
		});
		
		jQuery('#preview_area button').addClass( jQuery('#btn_color').val() );
	});
	
	jQuery('#btn_size').change(function() {
		jQuery('#btn_size option').each(function(index) {   
			jQuery('#preview_area button').removeClass(jQuery(this).val());
		});
		
		jQuery('#preview_area button').addClass( jQuery('#btn_size').val() );
	});

	
	
	jQuery('#btn_style').change(function() {
		
		if( jQuery(this).val() == 'none' ){
			jQuery('#btn_color').attr('disabled',false);
			jQuery('#btn_size').attr('disabled',false);
			jQuery('#style_on').hide();
			jQuery('#style_off').show();
		}
		else{
			jQuery('#btn_color').attr('disabled','disabled');
			jQuery('#btn_size').attr('disabled','disabled');
			jQuery('#style_off').hide();
			jQuery('#style_on').show();
			jQuery('#style_on button').attr('class','cosmobutton gray '+jQuery(this).val());
		}
	});
});


function resetButtons(){
    
    jQuery('#button-caption').val('');
    jQuery('#button-location').val('');
    
    jQuery("#btn_size option:first").prop('selected','selected');
    jQuery('#btn_color option:first').prop('selected','selected');    
    
    /*reset color*/
    jQuery('#btn_color option').each(function(index) {   
		jQuery('#preview_area button').removeClass(jQuery(this).val());
	});
	
	jQuery('#preview_area button').addClass('blue');
	
	/*reset size*/
	jQuery('#btn_size option').each(function(index) {   
		jQuery('#preview_area button').removeClass(jQuery(this).val());
	});
	
	jQuery('#preview_area button').addClass('small');
	
	
	/*reset btn caption*/
	jQuery('#btn_name').html( 'Button' );
	
	jQuery('#btn_color').prop('disabled',false);
	jQuery('#btn_size').prop('disabled',false);
	jQuery('#style_on').hide();
	jQuery('#style_off').show();
	
	jQuery('#btn_style option:first').prop('selected','selected');
}


function AddCaption(){
	
	if(jQuery('#button-caption').val() != ''){
		jQuery('#btn_name').html(jQuery('#button-caption').val());
		jQuery('#style_off_name').html('<span class="cosmo-ico">&nbsp;</span>'+jQuery('#button-caption').val());
		
	}
	else{
		jQuery('#btn_name').html( 'Button' );
		jQuery('#style_off_name').html( '<span class="cosmo-ico">&nbsp;</span>Button' );
	}
}

function AddButton(){
	
	var color = jQuery('#btn_color').val();
	var size = jQuery('#btn_size').val();
	var location = jQuery('#button-location').val();
	var style = jQuery('#btn_style').val();
	var new_window = false; 
	
	var caption =  'Button';
	
	if(jQuery.trim(jQuery('#button-caption').val() )){
		caption =  jQuery.trim(jQuery('#button-caption').val() );
	}
	
	if( jQuery('#new_window').attr('checked')){
		new_window = true; 
	}
	
	var btn_shcode = '[button size="'+size+'" color="'+color+'" style="'+style+'" new_window="'+new_window+'" link="'+location+'"]'+caption+'[/button]';
	
	Editor.AddText( "content" , "\n"+btn_shcode+"\n");
	showNotify();
}