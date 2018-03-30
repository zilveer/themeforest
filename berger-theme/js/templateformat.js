jQuery(document).ready(function($){
	

/*----------------------------------------------------------------------------------*/
/*	Display post format meta boxes as needed
/*----------------------------------------------------------------------------------*/
	
	
	jQuery('#post-formats-select input').change(checkFormat);
	
	function checkFormat(){
		var format = jQuery('#post-formats-select input:checked').attr('value');

		//only run on the posts page
		if(typeof format != 'undefined'){

            jQuery('*[id*=clapat_trent_theme_options-opt-blog-post]:visible').each(function() {

                jQuery(this).closest('tr').css('border-bottom', 'none');
                jQuery(this).prev().hide();
                jQuery(this).hide();

            });

            jQuery('*[id*=clapat_trent_theme_options-opt-blog-post-' + format + ']:hidden').each(function() {

                jQuery(this).prev().stop(true,true).fadeIn(500);
                jQuery(this).stop(true,true).fadeIn(500);
            });

		}
	
	}
	
	jQuery(window).load(function(){
		
		checkFormat();
		
	})
		
    
});


