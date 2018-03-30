/* When DOM is fully loaded */ 
jQuery(document).ready(function($) {


	/* Upload */
	var 
		sm_target_input,
		sm_image_container;
	
	window.original_send_to_editor = window.send_to_editor;
	
	sm_upload_item = function () {

		window.send_to_editor = function(html) {

		   	var 
				target_url = '',
				class_string = $('img', html).attr('class'),
				classes = class_string.split( /\s+/ );

            target_url = $('img', html).attr( 'src' );
            sm_target_input.val( target_url );
          
			tb_remove();

			window.send_to_editor = window.original_send_to_editor;
			return false;
		};
		
		sm_image_container = $( this ).parent();
		sm_target_input = sm_image_container.find( 'input' );
		tb_show('', 'media-upload.php?post_id=&amp;type=image&amp;TB_iframe=true');
		
		// Set high z-index
		$( '#TB_overlay' ).css( 'z-index', '400000' );
		$( '#TB_window' ).css( 'z-index', '400000' );

		return false;
	};


});