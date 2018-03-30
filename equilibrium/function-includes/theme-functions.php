<?php 

/*-----------------------------------------------------------------------------------*/
/* Get the id of the attachment by providing the source of the image. Needed for
 * finding the image's meta info, such as its width and height.
/*-----------------------------------------------------------------------------------*/

function eq_get_attachment_id_from_src( $image_src ) {
	
	global $wpdb;
	
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	
	return $id;
	
}


/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Layout
/*-----------------------------------------------------------------------------------*/

add_filter( 'body_class', 'eq_body_class' );
 
function eq_body_class( $classes ) {
	
	$sidebar_alignment = of_get_option( 'sidebar_alignment', 'two-cols-right-fixed' );
	
	$classes[] = $sidebar_alignment;
		
	return $classes;
	
}


/*-----------------------------------------------------------------------------------*/
/* General Settings */
/*-----------------------------------------------------------------------------------*/

/* Output the logo */

function eq_the_custom_logo() {
	
	$logo_url = of_get_option( 'custom_logo' );
	
	// If the logo is uploaded, get its size
	if ( $logo_url ) {			
		echo '<a href="' . get_home_url() . '" title="' . __( 'Return to the homepage', 'onioneye' ) . '">' .
			 	'<img src="' . $logo_url . '" alt="logo" />' . 
			 '</a>';
	}
	else {
		echo '<!-- START #wp-title-logo -->' .
			 '<a id="wp-title-logo" href="' . get_home_url() . '" title="' . __( 'Return to the homepage', 'onioneye' ) . '">' . get_bloginfo( 'title' ) . '</a>' .
			 '<!-- END #wp-title-logo -->';
	}
				
}



/* Output the URL of the current page */

function yy_the_current_page_url() {
	
	$page_url = 'http';
	
	if ( $_SERVER["HTTPS"] == "on" ) {
		$page_url .= "s";
	}
	
	$page_url .= "://";
		
	if ( $_SERVER["SERVER_PORT"] != "80" ) {
		$page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} 
	else {
		$page_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	
	return $page_url;
	
}



/* Add Favicon */

function yy_custom_favicon() {
	
	$favicon_url = of_get_option( 'custom_favicon' );
	
	if ( $favicon_url ) {
		echo '<link rel="shortcut icon" href="'.  $favicon_url  .'"/>'."\n";
	}
	else { ?>
		<link rel="shortcut icon" href="<?php echo bloginfo( 'stylesheet_directory' ) ?>/images/layout/favicon.ico" />
	<?php }	
	
}

add_action( 'wp_head', 'yy_custom_favicon' );



/* Number of Portfolio Projects Per Row */

function yy_get_number_of_items_per_row() {

    $post_count = of_get_option( 'number_of_projects_per_row' );
    
    if ( $post_count === 'two' ) {
      return 2;
    }
	if( $post_count === 'four' ) {
      return 4;
    }
    
    return 3; //return the default value
    
}


/*-----------------------------------------------------------------------------------*/
/* Social Networking */
/*-----------------------------------------------------------------------------------*/

function eq_social_networks() {

    $output = '';
	$social_networks = array ( 'rss', 'digg', 'delicious', 'skype', 'tumblr', 'dribbble', 'googleplus', 'linkedin', 'youtube', 'vimeo', 'flickr', 'facebook', 'twitter' );
	
	foreach ( $social_networks as $social_network ) {
		
		if ( $url = of_get_option( $social_network . '_url' ) ) {
				
			// Remove the URL filter on the skype link, to be able to use "callto://your_skype_id/", or similar values in the Skype URL field
			if ( $social_network !== 'skype' ) { 
				$output .= '<li><a id="' . $social_network . '-link" href="' . esc_url("{$url}") . '" title="' . $social_network . '">';    
			}
			else {
				$output .= '<li><a id="' . $social_network . '-link" href="' . "{$url}" . '" title="' . $social_network . '">'; 
			} 
 	  		
 	  		$output .= '<img src="' . get_template_directory_uri() . '/images/layout/' . $social_network . '.png" alt="' . $social_network . '" />';    
	 		$output .= "</a></li>\n";
		}
	}
    
    // Output Social Network Links
    if ($output <> '') {
      echo $output;
    } 
	
}


/*-----------------------------------------------------------------------------------*/
/* Portfolio Meta Box Values */
/*-----------------------------------------------------------------------------------*/

function eq_get_the_preview_img_url() {
	
	global $post;
	$preview_img = get_post_meta( $post->ID, 'portfolio-preview-img', true );
	
	return $preview_img;
	
}

function eq_get_the_portfolio_video_embed_code() {
	
	global $post;
	$video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );
	
	return $video_embed_code;
	
}

function eq_get_the_portfolio_images() {
	
	global $post;
	
	$img1 = get_post_meta( $post->ID, 'portfolio-image-1', true );
	$img2 = get_post_meta( $post->ID, 'portfolio-image-2', true );
	$img3 = get_post_meta( $post->ID, 'portfolio-image-3', true );
	$img4 = get_post_meta( $post->ID, 'portfolio-image-4', true );
	$img5 = get_post_meta( $post->ID, 'portfolio-image-5', true );
	$img6 = get_post_meta( $post->ID, 'portfolio-image-6', true );
	$img7 = get_post_meta( $post->ID, 'portfolio-image-7', true );
	$img8 = get_post_meta( $post->ID, 'portfolio-image-8', true );
	$img9 = get_post_meta( $post->ID, 'portfolio-image-9', true );
	$img10 = get_post_meta( $post->ID, 'portfolio-image-10', true );
	
	$meta_fields = array( $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $img9, $img10 );
	$image_urls = array();
	
	foreach($meta_fields as $meta_field) {
		if( $meta_field ) {
			$image_urls[] = $meta_field;
		}
	}
	
	return $image_urls;
	
}


/*-----------------------------------------------------------------------------------*/
/* Slider Meta Box Values */
/*-----------------------------------------------------------------------------------*/

function eq_get_the_slide_img_source() {
	
	global $post;
	$slide_img_src = get_post_meta( $post->ID, 'slide-img-src', true );
	
	return $slide_img_src;
	
}

function eq_get_the_slide_img_href() {
	
	global $post;
	$slide_img_href = get_post_meta( $post->ID, 'slide-img-href', true );
	
	return $slide_img_href;
	
}

function eq_get_the_slide_video_code() {
	
	global $post;
	$video_embed_code = get_post_meta( $post->ID, 'slide-video-embed', true );
	
	return $video_embed_code;
	
}


function eq_the_modal_window_html() {
	
	$menu = wp_nav_menu( array( 'echo' => 0, 'container' => 'nav', 'menu' => 'custom_menu', 'container_id' => 'menu', 'container_class' => 'container_12 group', 'depth' => 2 ) ); 
		  
	// If a link with a href attribute of "#modalContactForm" is defined in the menu, enqueue the script used to control the modal window, and add the appropriate HTML for it. 
	if( strpos( $menu, '#modalContactForm' )) {
		
		$email_address = of_get_option( 'email_address', '' );
		
		wp_register_script( 'modal-contact-form', get_template_directory_uri() . '/js/jquery.leanModal.min.js', array( 'jquery' ), false, true );
		wp_print_scripts( 'modal-contact-form' );
?>			
		<!-- START #modalContactForm -->    
	    <div id="modalContactForm">
			<h4>Contact</h4>
			
			<?php echo do_shortcode('[contact_form email="' . $email_address . '"]'); ?>
			
			<!-- START #close-reveal-modal --> 
			<a id="close-reveal-modal">&#215;</a>
			<!-- END #close-reveal-modal -->
	    </div>
	    <!-- END #modalContactForm -->
	
<?php	
	}
}
?>