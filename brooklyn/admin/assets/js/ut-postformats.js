(function($){
            
    $(document).ready(function() {
        		
        $.each($("input[name='post_format']:checked"), function() {
		    
            $('#ut-post-format-' + $(this).val()).show();
            $('.ut-post-format-state-' + $(this).val() ).addClass('active');
            
    	});
        
        $(document).on("change", "input[name='post_format']", function(e){ 
		    
            $('.ut-post-format-box').hide();
            $('#ut-post-format-' + $(this).val()).show();
            
            $('.ut-post-format-options a').removeClass('active');
            $('.ut-post-format-state-' + $(this).val() ).addClass('active');
            
	    });
        
        $(document).on("click", ".ut-post-format-options a", function(e){ 
            
            e.preventDefault();
            
            var postformat = $(this).data("ut-format");
            
            // change wp default post format radio
            $('#post-format-' + postformat).attr("checked", true);
            
            // hide all post format boxes
            $('.ut-post-format-box').hide();
            
            // show selected post format box
            $('#ut-post-format-' + postformat).show();
            
            // change button state
            $('.ut-post-format-options a').removeClass('active');
            $(this).addClass('active');
            
        
        });
		
		$(document).on("click", ".upload-button", function(event){	
      
			event.preventDefault();
			
			 // If the media frame already exists, reopen it.
			if ( frame ) {
				frame.open();
				return;
			}
			
			var button = $(this);    
			var input = button.siblings('input:text').first();
			var frame = wp.media( {
				title       : button.data( 'uploader_title' ),
				multiple    : false,
				library     : { type : button.data( 'limit_type' )},
				button      : { text : button.data( 'uploader_button_text' ) }
			} );
		
			frame.on( 'select', function() {
				var attachment = frame.state().get( 'selection' ).first().toJSON();
				$(input).val(attachment.url);
			} );
		
			frame.open();
			return false;
		
	  });
    
    }); // end document ready

})( jQuery );