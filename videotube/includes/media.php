<?php
if( !defined( 'ABSPATH' ) ) exit();
if( !function_exists( 'mediapress_add_query_vars' ) ){
	/**
	 * Adding tape var
	 * @param array $vars
	 * @return array
	 */
	function mediapress_add_query_vars( $vars ) {
		$vars[] = 'tape';
		return $vars;
	}
	add_filter( 'query_vars' , 'mediapress_add_query_vars', 100, 1);
}
if( !function_exists( 'mediapress_get_video_type' ) ){
	/**
	 * get video type
	 * @param int $post_id
	 * return string.
	 */
	function mediapress_get_video_type( $post_id ) {
		if( get_post_type( $post_id ) != 'video' || !$post_id )
			return;
		$type = get_post_meta( $post_id, 'video_type', true ) ? get_post_meta( $post_id, 'video_type', true ) : 'normal';
		return $type;
	}
}

if( !function_exists( 'mediapress_get_media_object' ) ){
	/**
	 * Get the media object, this can be a string, int or an array.
	 * @param unknown_type $post_id
	 * @return void|Ambigous <mixed, string, multitype:, boolean, unknown>
	 */
	function mediapress_get_media_object( $post_id ) {
		$tape = get_query_var( 'tape' ) ? absint( get_query_var( 'tape' ) ) : 1;
		$tape = $tape - 1; 
		$object = array();
		if( !$post_id ){
			return;	
		}
		if( mediapress_get_video_type( $post_id ) == 'files' ){
			$object	= get_post_meta( $post_id, 'video_file', true );
			if( is_array( $object ) && count( $object ) > 1 ){
				// this is an array of media files.
				// get the embed code of the first element.
				if( isset( $object[ $tape ] ) ){
					print mediapress_get_embedcode( $object[ $tape ] , $post_id);
				}
				else{
					print mediapress_get_embedcode( $object[0] , $post_id);
				}
				
			}
			elseif( is_array( $object ) && count( $object )  == 1 ){
				print mediapress_get_embedcode( $object[0] , $post_id);
			}
			else{
				// this is a single media file.
				// this should ne a integer.
				print mediapress_get_embedcode( $object , $post_id);				
			}
		}
		else{
			$object = get_post_meta( $post_id, 'video_url', true ) ? get_post_meta( $post_id, 'video_url', true ) : ( get_post_meta( $post_id, 'video_frame', true ) ? get_post_meta( $post_id, 'video_frame', true ) : null );
			$object	=	explode("\r\n", $object);
			$object	=	array_filter( $object );			
			if( is_array( $object ) ){
				if( count( $object ) > 1 ){
					if( isset( $object[ $tape ] ) ){
						print mediapress_get_embedcode( $object[ $tape ] , $post_id);
					}
					else{
						print mediapress_get_embedcode( $object[0] , $post_id);
					}
				}
				elseif( count( $object ) == 1 ){
					print mediapress_get_embedcode( $object[0] , $post_id);
				}
			}
			else{
				print mediapress_get_embedcode( $object , $post_id);
			}
		}
	}
	add_action( 'mediapress_media' , 'mediapress_get_media_object', 10, 1);
}

if( !function_exists( 'mediapress_get_embedcode' ) ){
	/**
	 * Return embedcode/iframe
	 * @param string/int $media_object.
	 * return iframe html;
	 */
	function mediapress_get_embedcode( $media_object, $post_id ) {
		global $videotube;
		$output = $shortcode = $poster = '';
		// check if this is media file.
		// 'mp4', 'm4v', 'webm', 'ogv', 'wmv', 'flv' support.
		if( mediapress_get_video_type( $post_id ) == 'files'){
			$media_object = (int)$media_object;
			// check if this file is publish.
			if( is_integer( $media_object ) ){
				// this is media file id.
				$media_url = wp_get_attachment_url( $media_object );
				if( !$media_url )
					return;
				// set the thumbnail image as poster.
				if( has_post_thumbnail( $post_id ) ){
					$post_thumbnail_id = get_post_thumbnail_id( $post_id );
					$thumb_image = wp_get_attachment_image_src( $post_thumbnail_id,'full' );					
					$poster = $thumb_image[0];
				}
				$media_object_file_args = array(
					'src'		=>		!empty( $media_url ) ? esc_url( $media_url ) : '',
					'poster'	=>		!empty( $poster ) ? esc_url( $poster ) : '',
					'loop'		=>		false,
					'autoplay'	=>		( $videotube['autoplay'] == 1 ) ? 'true' : 'false',
					'preload'	=>		'metadata',
					'width'		=>		'750',
					'height'	=>		'442'
				);
			
				$media_object_file_args = apply_filters( 'mediapress_media_object_file_args' , $media_object_file_args);
				// extract the array.
				extract($media_object_file_args, EXTR_PREFIX_SAME,'mediapress');
				
				if( shortcode_exists( 'KGVID' ) ){
					$options = get_option('kgvid_video_embed_options');
					$shortcode = '
						[KGVID
							poster="'.$poster.'"
							height="'.$options['height'].'"
							width="'.$options['width'].'"
							autoplay="'.$autoplay.'"
						]
							'.$src.'
						[/KGVID]
					';
				}
				else{
					$shortcode = '
						[video
							src="'.$src.'"
							poster="'.$poster.'"
							loop="'.$loop.'"
							autoplay="'.$autoplay.'"
							preload="'.$preload.'"
							height="'.$height.'"
							width="'.$width.'"
						]
					';					
				}
				$output .= $shortcode;
			}
		}	
		if( mediapress_get_video_type($post_id) == 'normal'){
			// get the embed code.
			$mediapress_object_url_args = array(
				'width'	=>	'',
				'height'	=>	''	
			);
			$mediapress_object_url_args = apply_filters( 'mediapress_media_object_url_args' , $mediapress_object_url_args);
					
			if( ! wp_oembed_get( $media_object, $mediapress_object_url_args ) ){
				// yeah, I'm an iframe.
				$output .= $media_object;
			}
			else{
				// I'm a link.
				$output .= wp_oembed_get( $media_object, $mediapress_object_url_args );
			}
		}
		if( ! post_password_required( $post_id ) ){
			$output = apply_filters( 'videotube_player' , $output );
			return do_shortcode( $output );
		}
		return get_the_password_form( $post_id );
	}
}

if( !function_exists( 'mediapress_get_media_pagination' ) ){
	function mediapress_get_media_pagination( $post_id ) {
		global $post;
		$tape = get_query_var( 'tape' ) ? absint( get_query_var( 'tape' ) ) : 1;
		$pagination_array = $temp = array();
		if( mediapress_get_video_type( $post_id ) == 'normal' ){
			$media_object = get_post_meta( $post_id, 'video_url', true );
			$temp	=	explode("\r\n", $media_object);
			if( is_array( $temp ) && count( $temp ) > 1 ){
				$pagination_array	=	$temp;
			}
		}
		else{
			$media_object = get_post_meta( $post_id, 'video_file', true );
			if( is_array( $media_object ) && !empty( $media_object ) ){
				$pagination_array	=	$media_object;
			}
		}
		$pagination_array	=	array_filter($pagination_array);
		if( is_array( $pagination_array ) && count( $pagination_array ) > 1 ){
			$prefix = get_option( 'permalink_structure' ) ? '?' : '&';
			print '<ul class="pagination post-tape">';
				for ($i = 1; $i <= count( $pagination_array ); $i++) {
					$current_link = isset( $post->ID ) ? esc_url( add_query_arg( array( 'tape'=>$i ), get_permalink( $post->ID ) ) ) : null;
					if( !isset( $pagination_array[$tape-1] ) ){
						$tape = 1;
					}
					$current_item = ( $i == $tape ) ? 'class="active"' : null;
					print '<li '.$current_item.'><a href="'.$current_link.'">'.$i.'</a></li>';
				}
			print '</ul>';
		}
	}
	add_action( 'mediapress_media_pagination' , 'mediapress_get_media_pagination', 10, 1);
}