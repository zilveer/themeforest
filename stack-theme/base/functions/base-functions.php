<?php

// Favicon
add_action('wp_head', 'favicon', 1);
add_action('admin_head', 'favicon', 1);
add_action('login_head', 'favicon', 1);
function favicon() {
    $favicon = wp_get_attachment_url( theme_options('branding', 'branding_favicon') );
    if( $favicon == '' ){
        $favicon = THEME_FRAMEWORK_ASSETS_URI . '/images/favicon.png';
    }
    echo '<link rel="icon" type="image/png" href="'.$favicon.'" />';
}

// Login Logo
add_action('login_head', 'custom_login_logo' );
function custom_login_logo() {
	$custom_login_logo = theme_options('branding', 'branding_admin_logo');

	if( $custom_login_logo != '' ) {
		$img = wp_get_attachment_image_src( $custom_login_logo, 'full' );
		if( $img[1] > 320 ) {
			echo '<style type="text/css">#login { width: '.$img[1].'px; }</style>';
		}
		echo '<style type="text/css">#login h1{ margin-bottom: 10px; margin-left: 8px; } #login h1 a { background-image:url('. wp_get_attachment_url( $custom_login_logo ) .') !important; background-position: center center; background-size: auto; height: '.$img[2].'px; width: 100%;</style>';
	}
}

// Site Title
function custom_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'custom_title', 10, 2 );

// Gen Stack
function gen_stack( $stack ) {
	include(locate_template('stacks/stack-'.$stack['template_id'].'.php'));
}

// Resize Image
function resize_image( $attachment_id, $width = false, $height = false, $crop = false ) {

}

// Theme Image
function gen_image_src ( $attachment_id, $width = false, $height = false, $crop = false ) {
	// If user provide attachment url instead of attachment id
	if(filter_var($attachment_id, FILTER_VALIDATE_URL)) {
		$attachment_id = get_attachment_id_from_src($attachment_id);
	}

	// get the file path
	$file = get_attached_file( $attachment_id );
	
	// validate attachment exist
	if($file == '') {
		return '';
	}

	// calculate and set width/height if one of width or height is false.
	if( $width == false xor $height == false ) {
		$img = wp_get_attachment_image_src($attachment_id, 'full');

		if($img != false) {
			$img_ratio = $img[1]/$img[2];
			if($width == false){
				$width = $height * $img_ratio;
			} else if ($height == false) {
				$height = $width / $img_ratio;
			}
		}
	}

	// build the resized filename
	$resize_extend = ($width != false) ? '-' . floor($width) : '';
	$resize_extend .= ($height != false) ? 'x' . floor($height) : '';
	$resize_extend .= ( $resize_extend != '' && $crop != false ) ? '-cropped' : '';
	$resized_file = $cachefile = substr_replace( $file, $resize_extend, strrpos( $file, '.' ), 0 );
	
	// check the resized file existance
	$cache_exist = file_exists($resized_file);
	if(!$cache_exist) {
		$editor = wp_get_image_editor( $file );
		$editor->resize( $width, $height, $crop );
		$new_image_info = $editor->save($resized_file);

		$url = path_to_url( $new_image_info['path'] );
	} else {
		$url = path_to_url( $resized_file );
	}

	return $url;
}

function path_to_url( $path ) {
	$upload_dir = wp_upload_dir();
	return str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $path);
}

function get_attachment_id_from_src( $image_src ) {
	global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}
function get_attachment_src_from_id( $id ) {
	$attachment = wp_get_attachment_image_src( $id, 'full' );
	return $attachment[0];
}

function gen_responsive_image_block ( $attachment_id, $specs, $alt='' ) {
	for($i=0; $i<count($specs); $i++) {
		$height = ( isset( $specs[$i]['height'] ) ) ? $specs[$i]['height'] : false;
		$crop = ( isset( $specs[$i]['crop'] ) ) ? $specs[$i]['crop'] : false;
		$specs[$i]['src'] = gen_image_src( $attachment_id, $specs[$i]['width'], $height, $crop );
	}
	$alt = get_the_title($attachment_id);
	
	$ret = "<span data-picture data-alt='".$alt."'>";
    	$ret .= "<span data-src='".$specs[count($specs)-2]['src']."'></span>";
    foreach ( $specs as $spec ) {
    	if( isset( $spec['media'] ) ) {
    		$ret .= "<span data-src='".$spec['src']."' data-media='".$spec['media']."'></span>";
    	}
	}
    	$ret .= "<noscript><img src='".$specs[count($specs)-2]['src']."' alt=''></noscript>";
    $ret .= "</span>";

    return $ret;
}

// Theme Option
function theme_options( $section = '', $field = '', $default = false ) {
	$options = get_option( THEME_SLUG . '_options' );
	if ( '' != $section && '' != $field ) {
		return ( isset( $options[$section][$field] ) && $options[$section][$field] ) ? $options[$section][$field] : $default;
	}
	elseif ( '' != $section ) {
		return ( isset( $options[$section] ) ) ? $options[$section] : $default;
	}
	else return $options;
}

// Get WPML post ID
function get_wpml_object_id( $id, $type ){
	if( function_exists('icl_object_id') ) return icl_object_id($id, $type);
	else return $id;
}

// Check if Login or Register page is displayed
function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

// Get current pape URL
function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}

// Convert Hex to RGB
function hex2rgb ($hex, $format = 'rgb(%d, %d, %d)') {
    if (strlen($hex) === 3) {
        $rgb = sprintf($format,
            hexdec($hex[0]),
            hexdec($hex[1]),
            hexdec($hex[2]));
    } elseif (strlen($hex) === 6) {
        $rgb = sprintf($format,
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)));
    } elseif (strlen($hex) === 7) {
        $rgb = sprintf($format,
            hexdec(substr($hex, 1, 2)),
            hexdec(substr($hex, 3, 2)),
            hexdec(substr($hex, 5, 2)));
    } else {
        $rgb = false;
    }

    return $rgb;
}

// Check IE
function is_ie() {
	preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
	if (count($matches)>1) {
		return $matches[1];
	} else {
		return false;
	}
}

// Yoast SEO
function nt_add_custom_content_to_analysis($content, $post)
{
	if(is_admin()) {
		$stacks = get_post_meta($post->ID, '_stack_builder_stacks', true);
		if(is_array( $stacks )) {
			ob_start();
			foreach ($stacks as $stack) {
				$stack['id'] = 'stack-'.$post->ID.'-'.$stack['stack_id'];
				if( $stack['template_id'] == 'page_content' ) {
					$stack['template_id'] = 'page_content_full_width';
					gen_stack( $stack );
				} else {
					gen_stack( $stack );
				}
			}
			$content .= ob_get_contents();
			ob_end_clean();
		}
	} else {
		return false;
	}
	return $content;
}
// add_filter('wpseo_pre_analysis_post_content', 'nt_add_custom_content_to_analysis', 10, 2);



