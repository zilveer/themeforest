<?php
/**
 * Media functions
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_post_class' ) ) {
	/**
	 * Add custom classes to post
	 *
	 * @access public
	 * @param array $classes
	 * @return array
	 */
	function wolf_post_class( $classes ) {

		//if ( is_page() )
			//return $classes;

		$post_id = get_the_ID();
		$format = null;
		$is_embed_video = false;
		$content = get_the_content();
		$has_post_thumbnail = has_post_thumbnail();

		$format = get_post_format() ? get_post_format() : 'standard';

		$featured = get_post_meta( $post_id, '_wolf_featured_post', true );

		$has_media = wolf_post_media( false );

		if ( $featured )
			$classes[] = 'is-featured';

		if ( $has_media )
			$classes[] = 'has-media';

		if ( $has_post_thumbnail )
			$classes[] = 'has-thumbnail';

		if ( ! $has_post_thumbnail )
			$classes[] = 'no-thumbnail';

		$pattern = get_shortcode_regex();

		if ( preg_match( "/$pattern/s", $content, $match ) ) {
			if ( 'video' == $match[2] || 'embed' == $match[2] ) {
				$classes[] = 'is-embed-video';
				$is_embed_video = true;
			}
		}

		if ( preg_match( "/$pattern/s", $content, $match ) ) {
			if ( 'audio' == $match[2] ) {
				$classes[] = 'is-embed-audio';
			}
		}

		if ( preg_match( wolf_get_regex( 'twitter' ), $content ) ) {
			$classes[] = 'has-tweet';
		}

		if ( 'standard' == $format || 'image' == $format ) {
			if ( ! preg_match( wolf_get_regex( 'instagram' ), $content ) && ! $has_post_thumbnail ) {
				$classes[] = 'text-only';
			}
		}

		if ( 'audio' == $format && ! wolf_featured_audio( false )  ) {
			$classes[] = 'text-only';
		}

		if ( 'video' == $format && ! wolf_featured_video( false )  ) {
			$classes[] = 'text-only';
		}

		if ( 'gallery' == $format && ! wolf_featured_gallery( false )  ) {
			$classes[] = 'text-only';
		}

		//'audio',
		//'playlist',
		//'wolf_jplayer_playlist',
		//'soundcloud',

		if ( preg_match( "/$pattern/s", $content, $match ) ) {
			if ( 'wolf_jplayer_playlist' == $match[2] ) {
				$classes[] = 'is-wolf-jplayer';
			}
		}

		if ( preg_match( "/$pattern/s", $content, $match ) ) {
			if ( 'playlist' == $match[2] ) {
				$classes[] = 'is-playlist';
			}
		}

		if ( wolf_get_first_soundcloud_url() && 'audio' == $format )
			$classes[] = 'is-soundcloud';

		if ( wolf_get_first_video_url() || $is_embed_video && 'video' == $format )
			$classes[] = 'is-video';

		if ( ( 'aside' == $format || 'status' == $format ) && preg_match( wolf_get_regex( 'twitter' ), $content ) ) {
			$classes[] = 'is-tweet';
		}

		if ( 'image' == $format && preg_match( wolf_get_regex( 'instagram' ), $content ) )
			$classes[] = 'is-instagram';

		if ( is_singular( 'gallery' ) ) {
			$classes[] = 'single-gallery-' . get_post_meta( $post_id, '_layout', true );
		}

		return $classes;
	}
	add_filter( 'post_class', 'wolf_post_class' );
}

if ( ! function_exists( 'wolf_featured_quote' ) ) {
	/**
	 * Returns the first quote in post
	 *
	 * @access public
	 * @return string
	 */
	function wolf_featured_quote() {

		global $post;

		$quote = null;
		$has_quote = preg_match( '#<blockquote[^>]*>([^<]+|<(?!/?blockquote)[^>]*>|(?R))+</blockquote>#', $post->post_content, $match );

		if ( $has_quote ) {

			$quote = $match[0];

			if ( ! is_single() ) {
				$quote = '<blockquote class="featured-quote">' . wolf_sample( $match[1] ) . '</blockquote>';
			}
		}

		return $quote;
	}
}

if ( ! function_exists( 'wolf_featured_instagram' ) ) {
	/**
	 * Returns the first embed instagram in post
	 *
	 * @access public
	 * @param bool $embed
	 * @return string
	 */
	function wolf_featured_instagram( $embed = true ) {


		$has_instagram = preg_match( wolf_get_regex( 'instagram' ), get_the_content(), $match );

		$instagram = null;

		if ( $has_instagram ) {

			if ( $embed ) {

				$instagram = wp_oembed_get( $match[0] );

			} else {
				$instagram = $match[0];
			}
		}
		return $instagram;
	}
}

if ( ! function_exists( 'wolf_featured_tweet' ) ) {
	/**
	 * Returns the first tweet in post
	 *
	 * @access public
	 * @param bool $embed
	 * @return string
	 */
	function wolf_featured_tweet( $embed = true ) {

		$has_tweet = preg_match( wolf_get_regex( 'twitter' ), get_the_content(), $match );

		$tweet = null;

		if ( $has_tweet ) {

			if ( $embed ) {

				$tweet = wp_oembed_get( $match[0] );

			} else {
				$tweet = $match[0];
			}
		}
		return $tweet;
	}
}

if ( ! function_exists( 'wolf_featured_gallery' ) ) {
	/**
	 * Returns the first gallery from post content.
	 * Changes image size depending on context
	 *
	 * @access public
	 * @param bool $do_shortcode
	 * @param string $size
	 * @return string
	 */
	function wolf_featured_gallery( $do_shortcode = true, $size = 'thumbnail' ) {

		$pattern = get_shortcode_regex();

		if ( preg_match( "/$pattern/s", get_the_content(), $match ) ) {

			$shortcode = $match[0];
			$shortcode_name = $match[2];

			$has_gallery_sc = false;

			if ( preg_match( '/gallery/i', $shortcode_name ) || preg_match( '/slider/i', $shortcode_name ) ) {
				$has_gallery_sc = true;
			}

			if ( $has_gallery_sc ) {
				if ( $do_shortcode )
					return do_shortcode( $shortcode );
				else
					return $shortcode;
			}
		}
	}
}

if ( ! function_exists( 'wolf_featured_audio' ) ) {
	/**
	 * Returns the first audio in post
	 * Looks for shortcode and soundcloud embed URL
	 *
	 * @access public
	 * @param bool $embed
	 * @return string
	 */
	function wolf_featured_audio( $embed = true ) {

		$audio = null;

		$pattern = get_shortcode_regex();
		$first_url = wolf_get_first_url();

		$shortcodes = array(
			'audio',
			'playlist',
			'wolf_jplayer_playlist',
			'soundcloud',
		);

		if ( preg_match( "/$pattern/s", get_the_content(), $match ) ) {

			if ( in_array( $match[2], $shortcodes ) ) {

				if ( $embed ) {
					$audio = do_shortcode( $match[0] );
				} else {
					$audio = $match;
				}
			} elseif ( preg_match( wolf_get_regex( 'soundcloud' ), $first_url ) ) {

				if ( $embed ) {
					$audio = wp_oembed_get( $first_url );
				} else {
					$audio = $first_url;
				}
			}

		} elseif ( preg_match( wolf_get_regex( 'soundcloud' ), $first_url ) ) {

			if ( $embed ) {
				$audio = wp_oembed_get( $first_url );
			} else {
				$audio = $first_url;
			}
		}
		return $audio;
	}
}

if ( ! function_exists( 'wolf_featured_video' ) ) {
	/**
	 * Returns the first video in post
	 * Looks for shortcode and embed URL
	 *
	 * @access public
	 * @param bool $embed
	 * @return string
	 */
	function wolf_featured_video( $embed = true ) {

		$video = null;

		$pattern = get_shortcode_regex();
		$shortcodes = array(
			'video',
			'playlist',
			'wpvideo',
		);

		if ( preg_match( "/$pattern/s", get_the_content(), $match ) ) {

			if ( in_array( $match[2], $shortcodes ) ) {

				if ( $embed ) {

					$video = do_shortcode( $match[0] );
				} else {
					$video = $match;
				}

			} else {

				$first_video_url = wolf_get_first_video_url();

				if ( $first_video_url ) {
					if ( $embed ) {

						$video = wp_oembed_get( $first_video_url );

					} else {
						$video = $first_video_url;
					}
				}
			}

		} else {

			$first_video_url = wolf_get_first_video_url();

			if ( $first_video_url ) {

				if ( $embed ) {

					$video = wp_oembed_get( $first_video_url );

				} else {
					$video = $first_video_url;
				}

			}
		}
		return $video;
	}
}

if ( ! function_exists( 'wolf_post_media' ) ) {
	/**
	 * Returns featured media
	 *
	 * @access public
	 * @param bool $embed
	 * @return string
	 */
	function wolf_post_media( $embed = true, $thumb_size = 'large' ) {

		$media = null;
		$post_id = get_the_ID();
		$format = get_post_format() ? get_post_format() : 'standard';
		$content = get_the_content();
		$has_thumbnail = has_post_thumbnail();

		$audio = wolf_featured_audio( false );
		$video = wolf_featured_video( false );
		$gallery = wolf_featured_gallery( false );
		$tweet = wolf_featured_tweet( false );
		$link = wolf_get_first_url();

		$is_standard = 'standard' == $format && $has_thumbnail;
		$is_image = 'image' == $format && $has_thumbnail;
		$is_instagram = 'image' == $format && preg_match( wolf_get_regex( 'instagram' ), $content );

		$is_audio = $audio && 'audio' == $format;
		$is_video = $video && 'video' == $format || 'video' == get_post_type( $post_id ) ? true : false;
		$is_quote = $format == 'quote';
		$is_gallery = $gallery && 'gallery' == $format;
		$is_link = $format == 'link' && $link;
		$is_tweet = $tweet && ( 'status' == $format || 'aside' == $format );
		//$is_status =  'status' == $format || 'aside' == $format;

		if ( $is_instagram ) {

			$media = wolf_featured_instagram( $embed );

		} elseif ( $is_video ) {

			$media = wolf_featured_video( $embed );

		} elseif ( $is_quote ) {

			$media = wolf_featured_quote();

		} elseif ( $is_link ) {

			if ( is_single() ) {
				$media = '<h1 class="entry-title"><a href="' . $link . '" target="_blank">' . get_the_title() . '</a></h1>';
			} else {
				$media = '<h2 class="entry-title"><a href="' . $link . '" target="_blank">' . get_the_title() . '</a></h2>';
				$media .= '<p>' . $link . '</p>';
			}

		} elseif ( $is_gallery ) {

			$media = wolf_featured_gallery( $embed, $thumb_size );

		} elseif ( $is_audio ) {

			if ( $embed ) {
				if ( $has_thumbnail ) {
					$media .= '<div class="entry-thumbnail">';
					$media .= '<a href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark">';
					$media .= get_the_post_thumbnail( $post_id, 'large' );
					$media .= '</a>';
					$media .= '</div>';
				}
				$media .= wolf_featured_audio( $embed );
			} else {
				$media = wolf_featured_audio( $embed );
			}

		} elseif ( $is_image ) {

			$img_excerpt = get_post( get_post_thumbnail_id() )->post_excerpt;
			$img_alt = esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) );

			$caption = ( $img_excerpt ) ? $img_excerpt : get_the_title();
			$caption = '';

			$img = wolf_get_post_thumbnail_url( 'extra-large' );
			$full_img = wolf_get_post_thumbnail_url( 'extra-large' );

			$lightbox_class = 'lightbox';
			$media = '<div class="entry-thumbnail">';
			$media .= "<a title='$caption' class='$lightbox_class zoom' href='$full_img'>";
			$media .= "<img src='$img' alt='$img_alt'>";
			$media .= '</a>';
			$media .= '</div>';

		} elseif ( $is_standard ) {
			$media = '<div class="entry-thumbnail">';

			if ( ! is_single() ) :
				$media .= '<a class="entry-link" href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark">';
			endif;

			$media .= get_the_post_thumbnail( $post_id, 'large' );

			if ( ! is_single() ) :
				$media .= '</a>';
			endif;
			$media .= '</div>';
		}

		return $media;
	}
}

if ( ! function_exists( 'wolf_get_first_link_url' ) ) {
	/**
	 * Return the URL for the first link in the post content or the permalink if no
	 * URL is found.
	 * Keep this function just in case  'cause we mostly use the function wolf_get_first_url
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_first_link_url() {
		$has_url = preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $match );
		$link = ( $has_url ) ? $match[1] : apply_filters( 'the_permalink', get_permalink() );

		return esc_url_raw( $link );
	}
}

if ( ! function_exists( 'wolf_get_first_url' ) ) {
	/**
	 * Return the first URL in the post if an URL is found
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_first_url() {

		$has_url = preg_match( '`\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))`', get_the_content(), $match );
		$link = ( $has_url ) ? $match[0] : get_permalink();

		return esc_url_raw( $link );
	}
}

if ( ! function_exists( 'wolf_get_first_soundcloud_url' ) ) {
	/**
	 * Returns the first soundcloud URL
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_first_soundcloud_url() {

		$has_soundlcloud_url = preg_match( wolf_get_regex( 'soundcloud' ), get_the_content(), $match );
		$link = ( $has_soundlcloud_url ) ? $match[0] : null;

		return esc_url( $link );
	}
}

if ( ! function_exists( 'wolf_get_first_video_url' ) ) {
	/**
	 * Return the first video URL in the post if a video URL is found
	 *
	 * @access public
	 * @return string
	 */
	function wolf_get_first_video_url( $post_id = null ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$content = get_post_field( 'post_content', $post_id );

		$has_video_url =
		// youtube
		preg_match( '#http?://(?:\www.)?\youtube.com/watch\?v=([A-Za-z0-9\-_]+)#', $content, $match )
		|| preg_match( '#https?://(?:\www.)?\youtube.com/watch\?v=([A-Za-z0-9\-_]+)#', $content, $match )
		|| preg_match( '#http?://(?:\www.)?\youtu.be/([A-Za-z0-9\-_]+)#', $content, $match )
		|| preg_match( '#https?://(?:\www.)?\youtu.be/([A-Za-z0-9\-_]+)#', $content, $match )

		// vimeo
		|| preg_match( '#vimeo\.com/([0-9]+)#', $content, $match )

		// other
		|| preg_match( '#http://blip.tv/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?dailymotion\.com/.*#', $content, $match )
		|| preg_match( '#http://dai.ly/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?hulu\.com/watch/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?viddler\.com/.*#', $content, $match )
		|| preg_match( '#http://qik.com/.*#', $content, $match )
		|| preg_match( '#http://revision3.com/.*#', $content, $match )
		|| preg_match( '#http://wordpress.tv/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?funnyordie\.com/videos/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?flickr\.com/.*#', $content, $match )
		|| preg_match( '#http://flic.kr/.*#', $content, $match );

		$video_url = ( $has_video_url ) ? esc_url( $match[0] ) : null;

		return $video_url;
	}
}

if ( ! function_exists( 'wolf_no_video_content' ) ) {
	/**
	 * Remove the first video from the post content
	 *
	 * @param
	 * @return
	 */
	function wolf_no_video_content( $post_id = null ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$no_https = str_replace( 'https', 'http', wolf_get_first_video_url() );
		$with_https = str_replace( 'http', 'https', wolf_get_first_video_url() );
		$content = get_post_field( 'post_content', $post_id );

		$content = str_replace( array( wolf_get_first_video_url(), $no_https, $with_https ), '', $content );

		return apply_filters( 'the_content', $content );
	}
}

if ( ! function_exists( 'wolf_get_regex' ) ) {
	/**
	 * Get most usefull regex
	 *
	 * @access public
	 * @param string $type
	 * @return string
	 */
	function wolf_get_regex( $type = null ) {

		$regex = array(

			'instagram' => '#http://instagr(\.am|am\.com)/p/.*#',
			'twitter' => '#https?://(www\.)?twitter\.com/.+?/status(es)?/.*#',
			'soundcloud' => '#https?://(www\.)?soundcloud\.com/.*#',
		);

		if ( array_key_exists( $type, $regex ) ) {

			return $regex[$type];
		}
	}
}

if ( ! function_exists( 'wolf_override_shortcode_video_dimensions' ) ) {
	/**
	 * Overrrides video shortcode dimension to always make it full width
	 *
	 * @access public
	 * @param string $output
	 * @param $pairs
	 * @param array atts
	 * @return array
	 */
	function wolf_override_shortcode_video_dimensions( $output, $pairs, $atts ) {

		$output['width'] = '800';
		$out['height'] = '450';
		return $output;
	}
	//add_filter( 'shortcode_atts_video', 'wolf_override_shortcode_video_dimensions', 10, 3 );
}

if ( ! function_exists( 'wolf_format_custom_content_output' ) ) {
	/**
	 * Format output for other content area that can't be handle by the_content() filter
	 * Such as additional content area from the theme options
	 *
	 * @access public
	 * @param string $content
	 * @return void
	 */
	function wolf_format_custom_content_output( $content ) {

		$array = array(
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
		);
		$content = strtr( $content, $array );

		return apply_filters( 'the_content', $content );
	}
}

if ( ! function_exists( 'wolf_no_media_content' ) ) {
	/**
	 * Excludes featured media from content.
	 * The featured media will be displayed at the top in single page
	 *
	 * @access public
	 * @return void
	 */
	function wolf_no_media_content() {

		global $post;

		if ( ! is_single() && $post->post_excerpt || is_search() ) {

			return get_the_excerpt();

		} else {

			$media = wolf_post_media( false );
			$media_https = str_replace( 'http', 'https', wolf_post_media( false ) );
			$post_types = array( 'post', 'work', 'video' );

			$content = get_the_content( wolf_more_text() );

			$array = array(
				'<p>[' => '[',
				']</p>' => ']',
				']<br />' => ']',
			);
			$content = strtr( $content, $array );

			if ( in_array( get_post_type(), $post_types ) && $media ) {

				$new_content = str_replace( $media, '', $content );
				$new_content = str_replace( $media_https, '', $new_content );

			} else {
				$new_content = $content;
			}

			return apply_filters( 'the_content', $new_content );
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Format Single Post Content
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wolf_content' ) ) {
	/**
	 * Excludes featured media from content.
	 * The featured media will be displayed at the top in single page
	 */
	function wolf_content() {

		global $post;

		if ( ! is_single() && $post->post_excerpt || is_search() ) {

			return '<p>' . get_the_excerpt() . '</p>';

		} else {

			$media = wolf_post_media( false );

			$post_types = array( 'post', 'video' );

			$content = get_the_content( wolf_more_text() );

			// http://www.youtube.com/watch?v=QhwUydU5_F8&list=UUsLuPQzf-UV3eKrc4F4S0Ew
			// http://www.youtube.com/watch?v=QhwUydU5_F8&list=UUsLuPQzf-UV3eKrc4F4S0Ew
			// debug( $media );
			// debug( $content );

			$array = array(
				'<p>[' => '[',
				']</p>' => ']',
				']<br />' => ']',
			);
			$content = strtr( $content, $array );

			if ( in_array( get_post_type(), $post_types ) && $media ) {

				$new_content = str_replace( $media, '', $content );

			} else {
				$new_content = $content;
			}

			return apply_filters( 'the_content', $new_content );
		}

	}
	//add_filter( 'the_content', 'wolf_content' );
}

if ( ! function_exists( 'wolf_get_video_iframe_embed_code' ) ) {
	/**
	 * Get the embed code from a youtube or vimeo URL
	 *
	 * @access public
	 * @return void
	 */
	function wolf_get_video_iframe_embed_code() {

		$url = wolf_get_first_video_url();

		if (
			preg_match( '#(?:\www.)?\youtube.com/watch\?v=([A-Za-z0-9\-_]+)#', $url, $match )
			|| preg_match( '#(?:\www.)?\youtu.be/([A-Za-z0-9\-_]+)#', $url, $match ) ) {

			//www.youtube.com/embed/iVAgTiBrrDA
			$video_id = $match[1];
			$url = '//www.youtube.com/embed/' . $video_id;
			$iframe = '<iframe width="420" height="315" src="' . $url . '" frameborder="0" allowfullscreen></iframe>';
			return htmlentities( $iframe );
		}

		// vimeo
		elseif ( preg_match( '#vimeo\.com/([0-9]+)#', $url, $match ) ) {
			$video_id = $match[1];
			$url = '//player.vimeo.com/video/' . $video_id;
			$iframe = '<iframe src="' . $url . '" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			return htmlentities( $iframe );
		}
	}
}