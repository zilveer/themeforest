jQuery(document).ready(function($){
	
    var upload_referer = '';
    var parent_slide = '';
    
    $( '#upload_logo_button' ).click( function() {

        upload_referer = 'logo';
        tb_show(
            'Upload your logo',
            'media-upload.php?referer=martanian-logo&amp;type=image&amp;TB_iframe=true&amp;post_id=0',
            false
        );
        
    		return false;
        
  	});
    
    $( '#upload_responsive_logo_button' ).click( function() {

        upload_referer = 'responsive_logo';
        tb_show(
            'Upload your logo',
            'media-upload.php?referer=martanian-responsive-logo&amp;type=image&amp;TB_iframe=true&amp;post_id=0',
            false
        );
        
    		return false;
        
  	});

    $( '#upload_header_background_button' ).click( function() {
    		
        upload_referer = 'header_background';
        tb_show(
            'Upload your header background image',
            'media-upload.php?referer=martanian-header-background&amp;type=image&amp;TB_iframe=true&amp;post_id=0',
            false
        );
        
    		return false;
        
  	});
    
    $( '.martanian-home-page-sort' ).on( 'click', '.change_section_image', function() {

        upload_referer = 'section_image';
        parent_slide = $( this ).parent().parent().siblings( '.section-image' );

        tb_show(
            'Change section image',
            'media-upload.php?referer=martanian-section-image&amp;type=image&amp;TB_iframe=true&amp;post_id=0',
            false
        );
        
    		return false;
        
  	});
    
    $( '.martanian-home-page-sort' ).on( 'click', '.change_person_image', function() {

        upload_referer = 'person_image';
        parent_slide = $( this ).parent().parent().siblings( '.person-image' );

        tb_show(
            'Change person image',
            'media-upload.php?referer=martanian-person-image&amp;type=image&amp;TB_iframe=true&amp;post_id=0',
            false
        );
        
    		return false;
        
  	});
    
    $( '.martanian-home-page-sort' ).on( 'click', '.change_gallery_image', function() {

        upload_referer = 'gallery_image';
        parent_slide = $( this ).parent().parent().siblings( '.gallery-image' );

        tb_show(
            'Change gallery image',
            'media-upload.php?referer=martanian-gallery-image&amp;type=image&amp;TB_iframe=true&amp;post_id=0',
            false
        );
        
    		return false;
        
  	});
	
  	window.send_to_editor = function( html ) {

        var image_url = $( 'img', html ).attr( 'src' );
        if( upload_referer == 'logo' ) {
        
            $( '#new_logo_url' ).val( image_url );
            tb_remove();
            
            $( '#logo_preview' ).attr( 'src', image_url );
      		  $( '#submit_options_form' ).trigger( 'click' );
        }
        
        else if( upload_referer == 'responsive_logo' ) {
        
            $( '#new_logo_responsive_url' ).val( image_url );
            tb_remove();
            
            $( '#logo_preview_responsive' ).attr( 'src', image_url );
      		  $( '#submit_options_form' ).trigger( 'click' );
        }
        
        else if( upload_referer == 'header_background' ) {
        
            $( '#new_header_image_url' ).val( image_url );
            tb_remove();
            
            $( '#upload_header_background_button' ).attr( 'value', 'File chosen.' );
      		  $( '#submit_options_form' ).trigger( 'click' );
        }
        
        else if( upload_referer == 'section_image' ) {
        
            parent_slide.children( 'td' ).children( '.image-place' ).html( '<img src="'+ image_url +'" alt="Section image" style="max-width: 400px; max-height: 300px;" />' );
            parent_slide.children( 'td' ).children( '.section_image_hidden' ).val( image_url );
            
            tb_remove();
        }
        
        else if( upload_referer == 'person_image' ) {
        
            parent_slide.children( 'td' ).children( '.image-place' ).html( '<img src="'+ image_url +'" alt="Person image" style="width: 100px; height: 100px;" />' );
            parent_slide.children( 'td' ).children( '.person_image_hidden' ).val( image_url );
            
            tb_remove();
        }
        
        else if( upload_referer == 'gallery_image' ) {
        
            parent_slide.children( 'td' ).children( '.image-place' ).html( '<img src="'+ image_url +'" alt="Gallery image" style="max-width: 400px; max-height: 300px;" />' );
            parent_slide.children( 'td' ).children( '.gallery_image_hidden' ).val( image_url );
            
            tb_remove();
        }     
  	}	
	
});