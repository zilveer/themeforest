<?php
/**
 *
 */
function mysite_get_post_image( $args = array() ) {
	global $mysite;
	
	$defaults = array(
		'index' => '',
		'column' => '',
		'thumb' => '',
		'link_class' => '',
		'preload' => ( isset( $mysite->mobile ) ? false : true ),
		'video_controls' => false,
		'echo' => true,
		'featured_post' => false
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( !empty( $video ) )
		$video = mysite_video( array( 'url' => $video, 'width' => $width, 'height' => $height, 'parse' => true, 'video_controls' => $video_controls ) );
		
	if( empty( $video ) )
	{
		$post_thumbnail_id = get_post_thumbnail_id();

		$auto_img = mysite_get_setting( 'auto_img' );

		if ( ( empty( $post_thumbnail_id ) ) && ( $auto_img[0] ) ) {
			$image = mysite_image_by_attachment();
			if( $image ) {
				$image[0] = $image['url'];
				$alt = $image['alt'];
			} else {
				if( !empty( $placeholder ) )
					$image[0] = THEME_IMAGES_ASSETS . '/post_thumb.png';
				else
					return false;
			}
			
		} elseif( empty( $post_thumbnail_id ) && !empty( $placeholder ) ) {
				$image[0] = THEME_IMAGES_ASSETS . '/post_thumb.png';
				
		} elseif( empty( $post_thumbnail_id ) ) {
			
			return false;
		}

		if( !empty( $post_thumbnail_id ) )
			$image = wp_get_attachment_image_src( $post_thumbnail_id, '' );

		$link_to = ( isset( $link_to ) ? $link_to : ( !empty( $args['video'] ) ? $args['video'] : ( ( is_single() || is_page() ) && empty( $placeholder ) ? $image[0] : get_permalink() ) ) );
		$prettyphoto = ( isset( $prettyphoto ) ? $prettyphoto : ( ( is_single() || is_page() ) && empty( $placeholder ) ? true : false ) );
		$image_tags = mysite_post_image_tags( $post_thumbnail_id, get_the_ID() );
		
		$img_args = array(
			'src' => $image[0],
			'alt' => ( isset( $alt ) ? $alt : $image_tags['alt'] ),
			'title' => $image_tags['title'],
			'height' => $height,
			'width' => $width,
			'class' => 'hover_fade_js',
			'link_to' => $link_to,
			'prettyphoto' => $prettyphoto,
			'link_class' => $link_class,
			'preload' => $preload,
			'portfolio_full' => ( !empty( $portfolio_full ) ? true : false ),
			'wp_resize' => ( !empty( $wp_resize ) ? true : false )
			
		);
		
		$post_img = mysite_display_image( $img_args );
	}
	
	if( empty( $post_img ) && empty( $video ) )
		return;
		
	$offset = $mysite->layout['images']['image_padding'];
	$load_width = $width + $offset;
	$load_height = $height + $offset;
	
	$out = '<div class="' . $img_class . '"' . ( !empty( $inline_width ) ? 'style="width:' . $load_width . 'px;"' : '' ) . '>';
	
	if( empty( $placeholder ) ) {
		ob_start(); mysite_post_image_begin();
		$out .= ob_get_clean();
	}
	
	if( empty( $video ) )
		$out .= $post_img;
	else
		$out .= $video;
	
	if( empty( $placeholder ) ) {
		ob_start(); mysite_post_image_end( $args );
		$out .= ob_get_clean();
	}
	
	$out .= '</div>';
	
	if ( !empty( $echo ) )
		echo $out;
	else
		return $out;
}

/**
 *
 */
function mysite_image_by_attachment() {
	$attachments = get_children(array(
		'post_parent' => get_the_ID(),
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'numberposts' => 1
	));
	
	if ( empty( $attachments ) )
		return false;
		
	foreach ( $attachments as $id => $attachment ) {
		$image = wp_get_attachment_image_src( $id, '' );
		$image_tags = mysite_post_image_tags( $id );
		$alt = $image_tags['alt'];
	}
	
	return array( 'url' => $image[0], 'alt' => $alt );
}

/**
 *
 */
function mysite_post_image_tags( $image_id, $post_id = '' ) {
	
	# Check to is if attachment image has alt
	$alt = '';
	$file_name = '';
	if( is_numeric( $image_id ) ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		$alt = esc_attr(trim( $alt ));
	}
	
	# If no alt generate from file name
	if( empty( $alt ) ) {
		$file = get_attached_file( $image_id );
		$info = pathinfo( $file );
		if( isset( $info['extension'] ) )
			$file_name =  basename( $file, '.' . $info['extension'] );
		
		if( !empty( $file_name ) )
			$alt = esc_attr(ucwords(str_replace( '-', ' ', str_replace( '_', ' ', $file_name ) )));
	}
	
	# Generate title tag from post title
	$title = '';
	
	if( !empty( $post_id ) )
		$title = esc_attr( apply_filters( 'the_title', get_post_field( 'post_title', $post_id ) ) );
		
	return array( 'title' => $title, 'alt' => $alt );
}

/**
 *
 */
function mysite_display_image( $args = array() ) {
	global $wp_query, $mysite;
	
	extract( $args );
	
	if ( empty( $src ) )
		return false;
		
	$image = $src;
	
	$image_path = explode( $_SERVER['SERVER_NAME'], $image );
	
	if( !empty( $image_path[1] ) ) {
		$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
		$image_info = @getimagesize( $image_path );
	}

	# If we cannot get the image locally, try for an external URL
	if ( empty( $image_info ) )
		$image_info = @getimagesize( $image );
	
	if( mysite_video( $args = array( 'url' => $image ) ) )
		$src = THEME_IMAGES_ASSETS . '/movie_thumb.png';
		
	elseif( empty( $image_info ) )
		$src = THEME_IMAGES_ASSETS . '/invalid_image.png';
		
	# Auto crop width
	if( empty( $no_preload_img ) && ( empty( $width ) || !is_numeric( $width ) ) ) {
		$width = ( !empty( $width ) ) ? $width : '';
		$width = mysite_auto_width( array( 'width' => $width, 'get_width' => $image_info[0] ) );
	}
	
	$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : $image_info[0];
	$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : $image_info[1];
	
	$image_resize = mysite_get_setting( 'image_resize' );
	$site_url = parse_url( THEME_URI );
	
	if( ( isset( $disable_resize ) ) || ( isset( $site_url['host'] ) && mysite_valid_ip( $site_url['host'] ) ) )
		$image = $src;
	
	elseif( !empty( $wp_resize ) )
		$image = mysite_wp_image( $src, $width, $height );
	
	elseif( ( mysite_get_setting( 'image_resize_type' ) == 'timthumb' ) && ( !$image_resize[0] ) && ( mysite_is_cache_writable() ) && ( $image_info[0] != $width || $image_info[1] != $height ) )
		$image = ( is_multisite() ? str_replace( trailingslashit( home_url() ), trailingslashit( network_home_url() ), THEME_URI ) : THEME_URI ) . '/lib/scripts/timthumb/thumb.php?src=' . mysite_wpmu_image( $src ) . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=1&amp;q=100';
	
	else
		$image = $src;
		
		
	$img_width = ( ( $width ) ? ' width="' . esc_attr( $width ) . '"' : '' );
	$img_height = ( ( $height ) ? ' height="' . esc_attr( $height ) . '"' : '' );
	
	$class = ( ( !empty( $class ) ) ? ' class="' . esc_attr( $class ) . '"' : '' );
	$title = ( ( !empty( $title ) ) ? esc_attr( $title ) : '' );
	$alt = ( ( !empty( $alt ) ) ? esc_attr( $alt ) : '' );
		
	$out = '<img' . $class . ' src="' . esc_url( $image ) . '" title="' . $title . '" alt="' . $alt . '"' . $img_width . $img_height . ' />';
	
	$link_style = '';
	
	# Image preloader
	$loader_img = '';
	if( !empty( $preload ) ) {
		$offset = $mysite->layout['images']['image_padding'];
		$load_width = $width + $offset;
		$load_height = $height + $offset;
		
		if( empty( $no_preload_img ) ) {
			$link_style = ' style="background:no-repeat center center;display:block;position:relative;height:' .
			esc_attr( $load_height ) . 'px;width:' . esc_attr( $load_width ) . 'px;' .
			( $image_resize[0] ? 'overflow:hidden;' : '' ) . '"';
			
			$loader_img = '<div class="mysite_preloader"><img src="' .
			esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);background-position:left center;"></div>';
		}
		
		if( empty( $link_to ) && empty( $no_preload_img ) )
			$out = $loader_img . '<span class="noscript">' . $out . '</span>';
		else
			$out = '<span class="noscript">' . $out . '</span>';
	}
	
	
	$effect = ( isset( $effect ) ) ? $effect : '';
	
	# Image links to
	if( !empty( $link_to ) && $effect != 'border' ) {
		
		$link_class = ( !empty( $link_class ) ) ? ' class="' . $link_class . '"' : '';
		
		$group = ( !empty( $group ) ) ? '[' . $group . ']' : '';
		$rel = ( !empty( $prettyphoto ) ) ? ' rel="prettyPhoto' . $group . '"' : '';
		
		$out = '<a' . $rel . ' href="' . esc_url( $link_to ) . '" title="' . $title . '"' . $link_class . $link_style . '>' . $out . $loader_img . '</a>';
	}

	# Image effects
	if( !empty( $effect ) && $effect != 'framed' ) {
		$image = $out;
		$out = '';
		
		if( $effect == 'border' ) {
			if( trim( $align ) == 'aligncenter' ) {
				$out .= '<div class="' . trim( $align ) . '">';
				$aligncenter = true;
				$align = '';
			}
				
			$out .= '<span class="transparent_frame' . $align . '">' . $image;
			$out .= '<a href="' . esc_url( $link_to ) . '" rel="prettyPhoto" title = "'.$title.'">';
			$out .= '<img alt="'.$alt.'" src="' . esc_url( THEME_IMAGES . '/shortcodes/transparent.gif' ) . '" style="height:' .
			esc_attr( $height-10 ) . 'px;width:' . esc_attr( $width-10 ) . 'px;" class="transparent_border">';
			
			$out .= '</a>';
			$out .= '</span>';
			
			if( isset( $aligncenter ) == 'aligncenter' )
				$out .= '</div>';
		}

		if( $effect == 'shadow' || $effect == 'framed_shadow' || $effect == 'reflect_shadow' ) {
			if( trim( $align ) == 'aligncenter' ) {
				$out .= '<div class="' . trim( $align ) . '">';
				$aligncenter = true;
				$align = '';
			}
			
			$out .= '<span class="shadow_frame' . $align . '">' . $image;
			$out .= '<img alt="" src="' . esc_url( THEME_IMAGES . '/shortcodes/image_shadow.png' ) . '" style="width:' .
			esc_attr( $width ) . 'px;' . ( $effect == 'reflect_shadow' ? 'top:' . -floor($height*0.5) . 'px;' : '' ) . '" class="image_shadow">';
			
			$out .= '</span>';
			
			if( isset( $aligncenter ) == 'aligncenter' )
				$out .= '</div>';
		}
		
		if( $effect == 'reflect' ) {
			if( trim( $align ) == 'aligncenter' ) {
				$out .= '<div class="' . trim( $align ) . '">';
				$aligncenter = true;
				$align = '';
			}
			
			$out .= $image;
			
			if( isset( $aligncenter ) == 'aligncenter' )
				$out .= '</div>';
		}
	}
	
	return $out;
}

/**
 *
 */
function mysite_wp_image( $image, $width = '', $height = '' ) {
	if( empty( $image ) )
		return;
		
	global $mysite;
		
	$image_path_array = explode( $_SERVER['SERVER_NAME'], $image );
	
	if( !isset( $image_path_array[1] ) && defined( 'DOMAIN_MAPPING' ) && function_exists('get_original_url') ) {
		$image_path_array = explode( get_original_url('siteurl'), $image );
	}
	
	if( is_multisite() ) {
		global $blog_id;
		
		if ( defined( 'UPLOADS' ) ) {
			
			if( is_main_site( $blog_id ) ) {
				$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path_array[1];
			} else {
				$upload_dir = wp_upload_dir();
				$image_path = str_replace( get_blog_details($blog_id)->path . 'files', $upload_dir['basedir'], $image_path_array[1] );
			}
			
		} else {
			
			// This works for both the main site & MU site in 3.5.1
			$image_path =  str_replace( get_blog_details($blog_id)->path, ABSPATH, $image_path_array[1] );
		}
		

	} else {
		$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path_array[1];
	}
		
	$image_info = pathinfo( $image_path );
	
	$image_sizes = @getimagesize( $image_path );
	
	# If we cannot get the image locally, try for an external URL
	if ( empty( $image_sizes ) )
		$image_sizes = @getimagesize( $image );
		
	if( mysite_video( $args = array( 'url' => $image ) ) )
		$image = THEME_IMAGES_ASSETS . '/movie_thumb.png';
		
	elseif( empty( $image_sizes ) )
		$image = THEME_IMAGES_ASSETS . '/invalid_image.png';
		
	if( !mysite_is_cache_writable() )
		return $image;
		
	$image_sizes[0] = ( !empty( $image_sizes[0] ) ) ? $image_sizes[0] : '';
	$image_sizes[1] = ( !empty( $image_sizes[1] ) ) ? $image_sizes[1] : '';
	
	# Auto crop width
	if( empty( $width ) || !is_numeric( $width ) )
		$width = mysite_auto_width( array( 'width' => $width, 'get_width' => $image_sizes[0] ) );
		
	$width = ( !empty( $_POST['img_width'] ) ? $_POST['img_width'] : ( !empty( $width ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : $image_sizes[0] ) );
	$height = ( !empty( $_POST['img_height'] ) ? $_POST['img_height'] : ( !empty( $height ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : $image_sizes[1] ) );
	
	$image_src[0] = THEME_URI . '/cache/' . basename( $image );
	$image_src[1] = $image_sizes[0];
	$image_src[2] = $image_sizes[1];
	
	$extension = '.'. $image_info['extension'];
	
	$no_ext_path = THEME_CACHE . '/' . $image_info['filename'];
	
	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
	
	# checking if the file size is larger than the target size
	# if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		# the file is larger, check if the resized version already exists
		if ( file_exists( $cropped_img_path ) ) {
			$image = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
		}

		if ( !file_exists( $cropped_img_path ) ) {
			# no cache files - let's resize it
			$new_img_path = image_resize( $image_path, $width, $height, $crop = true, $suffix = null, $dest_path = THEME_CACHE );
			
			# If there's an error lets try WordPress's ABSPATH instead of $_SERVER['DOCUMENT_ROOT']
			if( is_wp_error( $new_img_path ) )
				$new_img_path = image_resize( ABSPATH . $image_path_array[1], $width, $height, $crop = true, $suffix = null, $dest_path = THEME_CACHE );
				
			# If thers is still an error just return the orginal image.
			if( is_wp_error( $new_img_path ) )
				return $image;
				
			$new_img_size = getimagesize( $new_img_path );
			$image = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
		}
	}
	
	return $image;
}

/**
 *
 */
function mysite_wp_image_resize() {
	if( ( mysite_ajax_request() ) && ( isset( $_POST['ajax_image_resize_url'] ) ) ) {
		
		$nonce = $_POST['j5M5601'];
		
		if( !wp_verify_nonce( $nonce, home_url() ) ) die('Security check'); 
		
		$image = stripslashes( $_POST['ajax_image_resize_url'] );
		
		if( !mysite_is_cache_writable() )
		{
			$data = array('url' => $image );
			$echo = json_encode( $data );
			
		}
		else
		{
			$data = array('url' => mysite_wp_image( $image ) );
			$echo = json_encode( $data );
		}
		
		@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		echo $echo;

		exit();
	}
}

/**
 *
 */
function mysite_wpmu_image( $src ) {
	if( is_multisite() ) {
		
		global $blog_id;
		
		if ( defined( 'UPLOADS' ) ) {
			
			if( is_main_site( $blog_id ) ) {
				return $src;
				
			} else {
				
				$upload_dir = wp_upload_dir();
			 
				if( defined( 'DOMAIN_MAPPING' ) && function_exists('get_original_url') ) {
				
					$src = str_replace( trailingslashit( $upload_dir['baseurl'] ), trailingslashit( network_home_url() ) . trailingslashit( UPLOADS ) , $src );
					$src = str_replace( trailingslashit( get_original_url('siteurl') ), trailingslashit( network_home_url() ) . trailingslashit( UPLOADS ) , $src );
				
					return str_replace( '/files/files/', '/files/', $src );
				
				} else {
				
					return str_replace( trailingslashit( $upload_dir['baseurl'] ), trailingslashit( network_home_url() ) . trailingslashit( UPLOADS ) , $src );
				}
			}
			
		} else {
			
			return str_replace( trailingslashit( home_url() ), trailingslashit( network_home_url() ), $src );
		}

	} else {
		
		return $src;
	}
}

?>