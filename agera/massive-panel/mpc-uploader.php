<?php

global $shortname;

$shortname = "agera";

if ( is_admin() ) {
	
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// ---->>>> IMPORTANT THE DEFAULT MASSIVE PANEL NAME IS mp-settings !!!
	
	// Load additional css and js for image uploads on the Options Framework page
	$mp_page = 'toplevel_page_mp-settings';
	add_action( "admin_print_styles-$mp_page", 'mp_mlu_css', 0 );
	add_action( "admin_print_scripts-$mp_page", 'mp_mlu_js', 0 );	
}

/**
 * Sets up a custom post type to attach image to.  This allows us to have
 * individual galleries for different uploaders.
 */

if ( ! function_exists( 'mp_mlu_init' ) ) {
	function mp_mlu_init () {
		register_post_type( 'mp', array(
			'labels' => array(
				'name' => __( 'Massive Panel Internal Container', 'agera' ),
			),
			'public' => true,
			'show_ui' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array( 'title', 'editor' ), 
			'query_var' => false,
			'can_export' => true,
			'show_in_nav_menus' => false
		) );
	}
}

/**
 * Adds the Thickbox CSS file and specific loading and button images to the header
 * on the pages where this function is called.
 */

if ( ! function_exists( 'mp_mlu_css' ) ) {

	function mp_mlu_css () {
	
		$_html = '';
		$_html .= '<link rel="stylesheet" href="' . site_url() . '/' . WPINC . '/js/thickbox/thickbox.css" type="text/css" media="screen" />' . "\n";
		$_html .= '<script type="text/javascript">
		var tb_pathToImage = "' . site_url() . '/' . WPINC . '/js/thickbox/loadingAnimation.gif";
	    var tb_closeImage = "' . site_url() . '/' . WPINC . '/js/thickbox/tb-close.png";
	    </script>' . "\n";
	    
	    echo $_html;
		
	}

}

/**
 * Registers and enqueues (loads) the necessary JavaScript file for working with the
 * Media Library-driven AJAX File Uploader Module.
 */

if ( ! function_exists( 'mp_mlu_js' ) ) {

	function mp_mlu_js () {
		// Registers custom scripts for the Media Library AJAX uploader.
		wp_register_script( 'mp-medialibrary-uploader', get_template_directory_uri().'/massive-panel/js/mp-uploader.js', array( 'jquery', 'thickbox' ) );
		wp_enqueue_script( 'mp-medialibrary-uploader' );
		wp_enqueue_script( 'media-upload' );
	}

}

/**
 * Media Uploader Using the WordPress Media Library.
 *
 * Parameters:
 * - string $_id - A token to identify this field (the name).
 * - string $_value - The value of the field, if present.
 * - string $_mode - The display mode of the field.
 * - string $_desc - An optional description of the field.
 * - int $_postid - An optional post id (used in the meta boxes).
 *
 * Dependencies:
 * - mp_mlu_get_silentpost()
 */

if ( ! function_exists( 'mp_medialibrary_uploader' ) ) {

	function mp_medialibrary_uploader( $_id, $_value, $_mode = 'full', $_desc = '', $_postid = 0, $_name = '') {
		global $shortname;
		
		$mp_settings = get_option($shortname.'_options');
		
		// Gets the unique option id
		$option_name = $shortname.'_options';
	
		$output = '';
		$id = '';
		$class = '';
		$int = '';
		$value = '';
		$name = '';
		
		$id = strip_tags( strtolower( $_id ) );
		// Change for each field, using a "silent" post. If no post is present, one will be created.
		$int = mp_mlu_get_silentpost( $id );
		
		// If a value is passed and we don't have a stored value, use the value that's passed through.
		if ( $_value != '' && $value == '' ) {
			$value = $_value;
		}
		
		if ($_name != '') {
			$name = $option_name.'['.$id.']';
		} else {
			$name = $option_name.'['.$id.']';
		}
		
		if ( $value ) { $class = ' has-file'; }
		$output .= '<input id="' . $id . '" class="upload' . $class . ' mp-input-big mp-input-border" type="text" name="'.$name.'" value="' . $value . '" />' . "\n";
		$output .= '<input id="upload_' . $id . '" class="upload_button button" type="button" value="' . __( 'Upload', 'agera' ) . '" rel="' . $int . '" />' . "\n";
		
		if ( $_desc != '' ) {
			$output .= '<span class="of_metabox_desc">' . $_desc . '</span>' . "\n";
		}
		
		$output .= '<div class="screenshot" id="'.$id.'_image"><div class="mp-image-frame" id="' . $id . '_frame"></div>';
		if ( $value != '' ) { 
			$remove = '<a href="javascript:(void);" class="mlu_remove button">Remove</a>';
			$image = preg_match( '/.jpg|.jpeg|.png|.gif|.ico/', $value );
			//echo "value = ".$image;
			if ( $image ) {
				$output .= '<img src="' . $value . '" alt="" class="mp-image-border"/>'.$remove;
			} else {
				$parts = explode( "/", $value );
				for( $i = 0; $i < sizeof( $parts ); ++$i ) {
					$title = $parts[$i];
				}

				$output .= '<div class="no-preview"></div>'.$remove;			
				
			}	
		}
		$output .= '</div>';
		return $output;
	}	
}

/* Multi Uploader */

if ( ! function_exists( 'mp_medialibrary_multi_uploader' ) ) {

	function mp_medialibrary_multi_uploader( $_id, $_value, $_mode = 'full', $_desc = '', $_postid = 0, $_name = '') {
	
		$mp_settings = get_option($shortname.'_options');
		
		// Gets the unique option id
		$option_name = $shortname.'_options';
	
		$output = '';
		$id = '';
		$class = '';
		$int = '';
		$value = '';
		$name = '';
		
		$id = strip_tags( strtolower( $_id ) );
		// Change for each field, using a "silent" post. If no post is present, one will be created.
		$int = mp_mlu_get_silentpost( $id );
		
		// If a value is passed and we don't have a stored value, use the value that's passed through.
		if ( $_value != '' && $value == '' ) {
			$value = $_value;
		}
		
		if ($_name != '') {
			$name = $option_name.'['.$id.']';
		} else {
			$name = $option_name.'['.$id.']';
		}
		
		if ($value) {
			$class = ' has-file'; 
		}
		$value = trim($value);
		
		$output .= '<textarea rows="8" cols="86" id="' . $id . '" class="upload displayall-upload ' . $class . ' mp-textarea mp-input-border" name="'.$name.'">'.($value).'</textarea>'. "\n";
		
		
		$output .= '<input id="upload_' . $id . '" class="multi_upload_button button" type="button" value="' . __( 'Upload', 'agera' ) . '" rel="' . $int . '" />' . "\n";
		
		if ( $_desc != '' ) {
			$output .= '<span class="of_metabox_desc">' . $_desc . '</span>' . "\n";
		}
		
		$tempArray = split('http', $value);
		$ind = 0;
		
		foreach($tempArray as $key => $val){	
			if($ind == 1){	
				$output .= '<div class="multi-screenshot firstshot" >' . "\n";
			} elseif($ind == 6 || $ind == 11 || $ind == 16) {
				$output .= '<div class="multi-screenshot columnshot-first" >' . "\n";
			} elseif($ind > 6) {
				$output .= '<div class="multi-screenshot columnshot" >' . "\n";
			} else {
				$output .= '<div class="multi-screenshot" >' . "\n";
			}
			$output .= '<div class="mp-image-frame" ></div>';
			if ( $val != '' ) { 
				$remove = '<a href="javascript:(void);" class="mlu_remove_multi button">Remove</a>';
				$image = preg_match('/.jpg|.jpeg|.png|.gif|.ico/', $val);
				if ( $image ) {
					$output .= '<img src="http' . $val . '" alt="" class="mp-image-border"/>'.$remove.'';
				} else {
					$parts = explode( "/", $value );
					for( $i = 0; $i < sizeof( $parts ); ++$i ) {
						$title = $parts[$i];
					}

					// No output preview if it's not an image.			
					$output .= '<div class="no-preview-small">http'. $val .'</div>'.$remove.'';			
				}	
			}
			$output .= '</div>';
			$ind++;
		}
		
		return $output;
	}	
}


/**
 * Uses "silent" posts in the database to store relationships for images.
 * This also creates the facility to collect galleries of, for example, logo images.
 * 
 * Return: $_postid.
 *
 * If no "silent" post is present, one will be created with the type "mp"
 * and the post_name of "mp-$_token".
 *
 * Example Usage:
 * mp_mlu_get_silentpost ( 'mp_logo' );
 */

if ( ! function_exists( 'mp_mlu_get_silentpost' ) ) {

	function mp_mlu_get_silentpost ( $_token ) {
	
		global $wpdb;
		$_id = 0;
	
		// Check if the token is valid against a whitelist.
		// $_whitelist = array( 'of_logo', 'of_custom_favicon', 'of_ad_top_image' );
		// Sanitise the token.
		
		$_token = strtolower( str_replace( ' ', '_', $_token ) );
		
		// if ( in_array( $_token, $_whitelist ) ) {
		if ( $_token ) {
			
			// Tell the function what to look for in a post.
			
			$_args = array( 'post_type' => 'mp', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed' );
			
			// Look in the database for a "silent" post that meets our criteria.
			$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
			foreach ( $_args as $k => $v ) {
				$query .= ' AND ' . $k . ' = "' . $v . '"';
			} // End FOREACH Loop
			
			$query .= ' LIMIT 1';
			$_posts = $wpdb->get_row( $query );
			
			// If we've got a post, loop through and get it's ID.
			if ( count( $_posts ) ) {
				$_id = $_posts->ID;
			} else {
			
				// If no post is present, insert one.
				// Prepare some additional data to go with the post insertion.
				$_words = explode( '_', $_token );
				$_title = join( ' ', $_words );
				$_title = ucwords( $_title );
				$_post_data = array( 'post_title' => $_title );
				$_post_data = array_merge( $_post_data, $_args );
				$_id = wp_insert_post( $_post_data );
			}	
		}
		return $_id;
	}
}

/**
 * Trigger code inside the Media Library popup.
 */

if ( ! function_exists( 'mp_mlu_insidepopup' ) ) {

	function mp_mlu_insidepopup () {
	
		if ( isset( $_REQUEST['is_mp'] ) && $_REQUEST['is_mp'] == 'yes' ) {
		
			add_action( 'admin_head', 'mp_mlu_js_popup' );
			add_filter( 'media_upload_tabs', 'mp_mlu_modify_tabs' );
		}
	}
}

if ( ! function_exists( 'mp_mlu_js_popup' ) ) {

	function mp_mlu_js_popup () {

		$_of_title = $_REQUEST['of_title'];
		if ( ! $_of_title ) { $_of_title = 'file'; } // End IF Statement
?>
	<script type="text/javascript">
	<!--
	jQuery(function($) {
		
		jQuery.noConflict();
		
		// Change the title of each tab to use the custom title text instead of "Media File".
		$( 'h3.media-title' ).each ( function () {
			var current_title = $( this ).html();
			var new_title = current_title.replace( 'media file', '<?php echo $_of_title; ?>' );
			$( this ).html( new_title );
		
		} );
		
		// Change the text of the "Insert into Post" buttons to read "Use this File".
		$( '.savesend input.button[value*="Insert into Post"], .media-item #go_button' ).attr( 'value', 'Use this File' );
		
		// Hide the "Insert Gallery" settings box on the "Gallery" tab.
		$( 'div#gallery-settings' ).hide();
		
		// Preserve the "is_mp" parameter on the "delete" confirmation button.
		$( '.savesend a.del-link' ).click ( function () {
		
			var continueButton = $( this ).next( '.del-attachment' ).children( 'a.button[id*="del"]' );
			var continueHref = continueButton.attr( 'href' );
			continueHref = continueHref + '&is_mp=yes';
			continueButton.attr( 'href', continueHref );
		
		} );
		
	});
	-->
	</script>
<?php
	}
}

/**
 * Triggered inside the Media Library popup to modify the title of the "Gallery" tab.
 */

if ( ! function_exists( 'mp_mlu_modify_tabs' ) ) {

	function mp_mlu_modify_tabs ( $tabs ) {
		$tabs['gallery'] = str_replace( __( 'Gallery', 'mp' ), __( 'Previously Uploaded', 'mp' ), $tabs['gallery'] );
		return $tabs;
	}
}