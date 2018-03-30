/* <![CDATA[ */
;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        var file_frame;
 
        $('.additional-user-image').on('click', function( event ){
     
            event.preventDefault();
     
            if ( file_frame ) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media({
                title: $( this ).data( 'uploader_title' ),
                button: {
                    text: $( this ).data( 'uploader_button_text' ),
                },
                multiple: false  
            });
     
            file_frame.on( 'select', function() {
                attachment = file_frame.state().get('selection').first().toJSON();     
            });     
        
            file_frame.open();
        
        });
        
    });
	
})(jQuery);
 /* ]]> */