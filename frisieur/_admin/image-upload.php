<?php

   /**
    *
    * enqueue admin scripts
    * 
    */                
    
    add_action( 'admin_enqueue_scripts', 'martanian_admin_options_enqueue_scripts' );
    function martanian_admin_options_enqueue_scripts() {
    
        wp_register_script(
            'martanian-image-upload',
            get_template_directory_uri() .'/_assets/_js/martanian-image-upload.js',
            array(
                'jquery',
                'media-upload',
                'thickbox'
            )
        );

        if( 'toplevel_page_martanian_admin' == get_current_screen() -> id ) {
        		
            wp_enqueue_script( 'dashboard' );
            wp_enqueue_script( 'jquery' );
        		wp_enqueue_script( 'thickbox' );
        		wp_enqueue_script( 'media-upload' );
        		wp_enqueue_script( 'martanian-image-upload' );  
            
            wp_enqueue_style( 'thickbox' );    		
      	}    	
    } 
    
   /**
    *
    * filter for images upload
    * 
    */                

    add_action( 'admin_init', 'martanian_images_upload_settings' );
    function martanian_images_upload_settings() {
    
        global $pagenow;
    	  if( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
    
    		    add_filter( 'gettext', 'martanian_replace_thickbox_text', 1, 2 );
    	  }
    }
    
   /**
    *
    * replace thickbox text for images upload
    *
    */                
    
    function martanian_replace_thickbox_text( $translated_text, $text ) {	
    
        if( 'Insert into Post' == $text ) {
    
    		    $referer_1 = strpos( wp_get_referer(), 'martanian-logo' );
            $referer_2 = strpos( wp_get_referer(), 'martanian-responsive-logo' );
    		    
            if( $referer_1 != '' || $referer_2 != '' ) return( __( 'Use as website logo', 'martanian' ) );
            else {
                
                $referer = strpos( wp_get_referer(), 'martanian-header-background' );
		            if( $referer != '' ) return( __( 'Use as header background!', 'martanian' ) );
                else {
                
                    $referer = strpos( wp_get_referer(), 'martanian-section-image' );
		                if( $referer != '' ) return( __( 'Use as section image!', 'martanian' ) );
                    else {
                    
                        $referer = strpos( wp_get_referer(), 'martanian-person-image' );
		                    if( $referer != '' ) return( __( 'Use as person image!', 'martanian' ) );
                        else {
                        
                            $referer = strpos( wp_get_referer(), 'martanian-gallery-image' );
		                        if( $referer != '' ) return( __( 'Use as gallery image!', 'martanian' ) );
                        }
                    }
                }
            }
    	  }     
    
    	  return( $translated_text );
    } 
    
   /**
    *
    * image delete function
    * 
    */                
    
    function martanian_delete_image( $image_url ) {
	
        global $wpdb;
    
    	  $query = "SELECT id
                  FROM {$wpdb->prefix}posts
                  WHERE guid = '". esc_url( $image_url ) ."'
                    AND post_type = 'attachment'
                  LIMIT 1";
                    
    	  $results = $wpdb -> get_results( $query );
      	foreach( $results as $row ) { wp_delete_attachment( $row -> id ); }
    } 
    
   /**
    *
    * end of file
    * 
    */                

?>