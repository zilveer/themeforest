/* <![CDATA[ */
;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        var file_frame,
            unite_media_field = '';
    
        $('.additional-user-image').on('click', function( event ){
     
            event.preventDefault();
            
            unite_media_field = $(this).data('field');
            
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
                
                var attachment = file_frame.state().get('selection').first().toJSON();
                $('#' + unite_media_field).val(attachment.url);
                
            });     
        
            file_frame.open();
        
        });
        
        $(document).on('click', '.delete-user-image', function( event ) {
            
            event.preventDefault();
            
            var field = $(this).data('field');
            
            /* delete field value */
            $('#' + field).val('');
            
            /* delete preview image */
            if( $('#' + field + '_preview').length ) {
                
                $('#' + field + '_preview').fadeOut( 800, function(){
                    
                    $(this).remove();
                    
                });
                
            }
        
        });
        
    });
	
})(jQuery);
 /* ]]> */