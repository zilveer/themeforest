<?php

/**
 * Post-format functions
 *
 * @package wpv
 */

/**
 * class WpvPostFormats
 */
class WpvPostFormats {
	/**
	 * Returns the icon denoting the current post format
	 *
	 * @param  string $format post format name
	 * @return string         icon name
	 */
	public static function get_post_format_icon( $format ) {
		if ( is_sticky() )
			return 'pushpin';

		$formats = apply_filters(
			'wpv_post_format_icons', array(
				'aside' => 'notebook',
				'audio' => 'music2',
				'gallery' => 'theme-gallery',
				'image' => 'theme-camera',
				'link' => 'link',
				'quote' => 'quotes-right2',
				'standard' => 'pencil1',
				'status' => 'notebook',
				'video' => 'theme-video',
			)
		);

		if ( isset( $formats[$format] ) )
			return $formats[$format];

		return 'theme-pencil';
	}

	/**
	 * Process the data for the current post according to its format
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data, possibly modified for the respective post format
	 */
	public static function process( $post_data ) {
		$post_data_unchanged = $post_data;

		$process_method = 'format_'.$post_data['format'];
		if ( method_exists( __CLASS__, $process_method ) )
			$post_data = call_user_func( array( __CLASS__, $process_method ), $post_data );

		$post_data['content'] = apply_filters( 'the_content', $post_data['content'] );

		if ( isset( $post_data['media'] ) && empty( $post_data['media'] ) ) {
			unset( $post_data['media'] );
			unset( $post_data['act_as_image'] );
			$post_data['act_as_standard'] = true;
		}

		return apply_filters( 'wpv_post_format_process', $post_data, $post_data_unchanged );
	}

	/**
	 * Get the first gallery from the post content
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data modified for the gallery post format
	 */
	private static function format_gallery( $post_data ) {
		if ( isset( $post_data['layout'] ) && $post_data['layout'] === 'scroll-x' ) {
			return self::format_image( $post_data );
		}

		list( $gallery, $post_data['content'] ) = self::get_first_gallery( $post_data['content'], $post_data['p']->post_content, self::get_thumb_name( $post_data ) );

		$post_data['media'] = do_shortcode( $gallery );

		return $post_data;
	}

	/**
	 * Get the post format image
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data modified for the image post format
	 */
	private static function format_image( $post_data ) {
		$post_data['media'] = get_the_post_thumbnail( $post_data['p']->ID, self::get_thumb_name( $post_data ) );

		return $post_data;
	}

	/**
	 * Standard post format
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data modified for the image post format
	 */
	private static function format_standard( $post_data ) {
		$post_data = self::format_image( $post_data );
		$post_data['act_as_image'] = true;

		return $post_data;
	}

	/**
	 * Get the post format video
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data modified for the video post format
	 */
	private static function format_video( $post_data ) {
		if ( ! is_single() )
			$post_data['media'] = get_the_post_thumbnail( $post_data['p']->ID, self::get_thumb_name( $post_data ) );

		if ( ! isset( $post_data['media'] ) || empty( $post_data['media'] ) ) {
			global $wp_embed;
			$post_data['media'] = do_shortcode( $wp_embed->run_shortcode( '[embed]'.get_post_meta( $post_data['p']->ID, 'wpv-post-format-video-link', true ).'[/embed]' ) );
		} else {
			$post_data['act_as_image'] = true;
		}

		return $post_data;
	}

	/**
	 * Get the post format audio
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data modified for the audio post format
	 */
	private static function format_audio( $post_data ) {
		global $wp_embed;
		$post_data['media'] = do_shortcode( $wp_embed->run_shortcode( '[embed]'.get_post_meta( $post_data['p']->ID, 'wpv-post-format-audio-link', true ).'[/embed]' ) );

		return $post_data;
	}

	/**
	 * Get the post format quote
	 *
	 * @param  array $post_data current post data
	 * @return array            current post data modified for the quote post format
	 */
	private static function format_quote( $post_data ) {
		$quote = self::get_the_post_format_quote( $post_data['p'] );

		// Replace the existing quote in-place.
		if ( ! empty( $quote ) ) {
			$post_data['content'] = $quote;
		}

		return $post_data;
	}

	/**
	 * Returns the correct thumbnail name for the current post
	 *
	 * @param  array  $post_data current post data as used in WpvPostFormats::process( $post_data )
	 * @return string            thumbnail name
	 */
	public static function get_thumb_name( $post_data ) {
		if ( $post_data['p']->post_type == 'portfolio' ) {
			$thumb_prefix = is_single() ? 'single-portfolio' : 'portfolio-loop';
			$thumb_suffix = is_single() ? '' : '-'.( isset( $GLOBALS['wpv_portfolio_column'] ) ? $GLOBALS['wpv_portfolio_column'] : 1 );
		} else {
			extract( self::post_layout_info() );
			$thumb_prefix = is_single() ? 'single-post' : (
							$news ? (
								$layout === 'masonry' && ! has_post_format( 'gallery' )?
									'portfolio-masonry' : 'post-small' ) :
							'post-loop' );
			$thumb_suffix = $news ? '-'.$column : '';
		}

		return $thumb_prefix.$thumb_suffix;
	}

	/**
	 * Post layout settings
	 *
	 * @return array filtered post layout settings
	 */
	public static function post_layout_info() {
		global $wpv_loop_vars;

		$result = array();

		if ( is_array( $wpv_loop_vars ) ) {
			$result['show_image']   = ( $wpv_loop_vars['image'] == 'true' );
			$result['show_content'] = $wpv_loop_vars['show_content'];
			$result['news']         = ( $wpv_loop_vars['news'] == 'true' );
			$result['width']        = $wpv_loop_vars['width'];
			$result['column']       = $wpv_loop_vars['column'];
			$result['layout']       = isset( $wpv_loop_vars['layout'] ) ? $wpv_loop_vars['layout'] : 'normal';
		} else {
			$result['show_image']   = true;
			$result['show_content'] = true;
			$result['width']        = 'full';
			$result['news']         = false;
			$result['column']       = 1;
			$result['layout']       = 'normal';
		}

		return apply_filters( 'wpv_post_layout_into', $result );
	}

	/**
	 * Get the first [gallery] shortcode from a string
	 *
	 * @param  string|null $content           search string
	 * @param  string|null $original_content  content to extract the gallery from
	 * @param  string      $thumbnail_name    thumbnail name for the current gallery
	 * @return array                          gallery shortcode and filtered content string
	 */
	public static function get_first_gallery( $content = null, $original_content = null, $thumbnail_name = 'thumbnail' ) {
		if ( is_null( $original_content ) )
			$original_content = $content;

		preg_match( '!\[(?:wpv_)?gallery.*?\]!', $original_content, $matches );

		$gallery = '';
		if ( ! empty( $matches ) ) {
			$gallery = $matches[0];

			if ( strpos( $gallery, 'wpv_gallery' ) === false ) $gallery = str_replace( '[gallery', '[wpv_gallery', $gallery );

			$gallery = preg_replace( '/size="[^"]*"/', '', $gallery );
			$gallery = str_replace( '[wpv_gallery', '[wpv_gallery size="'.$thumbnail_name.'"', $gallery );

			$content = trim( preg_replace( '/'.preg_quote( $matches[0], '/' ).'/', '', $content, 1 ) );
		}

		return array( $gallery, $content );
	}

	/**
	 * Get a quote from the post content
	 *
	 *
	 * @uses get_content_quote()
	 *
	 * @param object $post ( optional ) A reference to the post object, falls back to get_post().
	 * @return string The quote html.
	 */
	public static function get_the_post_format_quote( &$post = null ) {
		if ( empty( $post ) )
			$post = get_post();

		if ( empty( $post ) )
			return '';

		$quote  = $post->post_content;
		$source = '';
		$author = get_post_meta( $post->ID, 'wpv-post-format-quote-author', true );
		$link   = get_post_meta( $post->ID, 'wpv-post-format-quote-link', true );

		if ( ! empty( $author ) ) {
			$thumb = get_the_post_thumbnail( $post->ID, 'thumbnail' );

			$author = empty( $thumb ) ? $author : "$thumb <span class='quote-author'>$author</span>";

			$source = empty( $link ) ?
				$author :
				sprintf( '<a href="%s">%s</a>', esc_url( $link ), $author );
		}

		$quote = preg_replace( '!</?\s*blockquote.*?>!i', '', $quote );

		$content = wpautop( $quote );
		$cite    = "<div class='cite'>$source</div>";
		return "<blockquote class='clearfix large simple'>$cite<div class='quote-text'>".do_shortcode( $content ).'</div></blockquote>';
	}
}