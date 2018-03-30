<?php
/**
 * Class that handles OpenGraph meta tags.
 * 
 * @since   3.7.2
 */

class The7_OpenGraph {

	/**
	 * Output the site name straight from the blog info.
	 */
	public static function site_name() {
		self::og_tag( 'og:site_name', get_bloginfo( 'name' ) );
	}

	/**
	 * Output post title.
	 *
	 * @link https://developers.facebook.com/docs/reference/opengraph/object-type/article/
	 */
	public static function title() {
		self::og_tag( 'og:title', get_the_title() );
	}

	/**
	 * Output post excerpt as description.
	 */
	public static function description() {
		self::og_tag( 'og:description', get_the_excerpt() );
	}

	/**
	 * Output post thumbnail if any as image.
	 */
	public static function image() {
		$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		if ( isset( $post_thumbnail[0] ) ) {
			self::og_tag( 'og:image', esc_url( $post_thumbnail[0] ) );
		}
	}

	/**
	 * Output url.
	 *
	 * @link https://developers.facebook.com/docs/reference/opengraph/object-type/article/
	 */
	public static function url() {
		self::og_tag( 'og:url', esc_url( get_the_permalink() ) );
	}

	/**
	 * Output the OpenGraph type.
	 *
	 * @link https://developers.facebook.com/docs/reference/opengraph/object-type/object/
	 */
	public static function type() {
		if ( is_front_page() || is_home() ) {
			$type = 'website';
		} elseif ( is_singular() ) {
			$type = 'article';
		} else {
			// We use "object" for archives etc. as article doesn't apply there.
			$type = 'object';
		}

		self::og_tag( 'og:type', $type );
	}

	/**
	 * Output the OpenGraph meta tag.
	 *
	 * @param $property
	 * @param $content
	 *
	 * @return bool
	 */
	public static function og_tag( $property, $content ) {
		if ( ! is_string( $content ) || ! $content ) {
			return false;
		}

		echo '<meta property="', esc_attr( $property ), '" content="', esc_attr( $content ), '" />', "\n";
		return true;
	}
}
