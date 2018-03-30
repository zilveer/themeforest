
jQuery(document).ready(function() {
	jQuery("#show_content").click(function(){
		jQuery("#toggle_demo_content").fadeIn("fast");
		jQuery('#show_content').hide();
		jQuery('#hide_content').show();
	});

	jQuery("#hide_content").click(function(){
		jQuery("#toggle_demo_content").fadeOut("fast");
		jQuery('#hide_content').hide();
		jQuery('#show_content').show(); 
	});


	
	/*------------------*/
	jQuery('#open_title').keyup(function() {
		if(jQuery('#open_title').val() != ''){
			jQuery('#show_content').html(jQuery('#open_title').val());
		}
		else{
			jQuery('#show_content').html( 'Show content' );
		}
	});
	
	jQuery('#close_title').keyup(function() {
		if(jQuery('#close_title').val() != ''){
			jQuery('#hide_content').html(jQuery('#close_title').val());
		}
		else{
			jQuery('#hide_content').html( 'Hide content' );
		}
	});
	/*------------------*/
	
	jQuery('#toggle_content').keyup(function() {
		
		if(jQuery('#toggle_content').val() != ''){
			jQuery('#toggle_demo_content').html(jQuery('#toggle_content').val());
		}
		else{
			jQuery('#toggle_demo_content').html( 'Toggled content.' );
		}
			
	});
});	

function insertToggle(){
	
	var openText = 'Show the Content';
	var closeText = 'Hide the Content';
	var is_closed = true;
	var content = 'Type here the content.';
	
	if( jQuery.trim(jQuery('#open_title').val()) != ''){
		openText = jQuery.trim(jQuery('#open_title').val());
	}
	
	if( jQuery.trim(jQuery('#close_title').val()) != ''){
		closeText = jQuery.trim(jQuery('#close_title').val());
	}
	
	if(! jQuery('#hidden_content').attr('checked')){
		is_closed = false;
	}
	
	
	if(jQuery.trim(jQuery('#toggle_content').val()) != ''){
		content = jQuery.trim(jQuery('#toggle_content').val());
	}
	var toggle_shortcode = '[toggle title_open="'+openText+'" title_closed="'+closeText+'" hide="'+is_closed+'" ]'+content+'[/toggle] ';
	Editor.AddText( "content" , "\n"+toggle_shortcode+"\n");
	showNotify();
}