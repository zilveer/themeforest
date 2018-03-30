<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class DT_Blog_Shortcode_HTML
 */
class DT_Blog_Shortcode_HTML {

	/**
	 * Return fancy date HTML.
	 *
	 * @return string
	 */
	public static function get_fancy_date() {
		if ( ! in_the_loop() ) {
			return '';
		}

		$href = 'javascript:void(0);';

		// remove link if in date archive
		if ( !( is_day() && is_month() && is_year() ) ) {
			$href = presscore_get_post_day_link();
		}

		return '<a class="post-fancy-date" title="' . esc_attr( get_the_time() ) . '" href="' . $href . '" rel="nofollow">'
		       . '<span class="entry-month">' . esc_html( get_the_date( 'M' ) ) . '</span>'
		       . '<span class="entry-date updated">' . esc_html( get_the_date( 'j' ) ) . '</span>'
		       . '</a>';
	}

	/**
	 * Return fancy category HTML.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	public static function get_fancy_category( $args = array() ) {
		$default = array(
			'custom_text_color' => true,
			'custom_bg_color' => true,
		);
		$args = wp_parse_args( $args, $default );

		$post_type = get_post_type();

		if ( 'post' === $post_type ) {
			$taxonomy = 'category';
		} else {
			$taxonomy = "{$post_type}_category";
		}

		$terms = get_the_terms( get_the_ID(), $taxonomy );

		if ( is_wp_error( $terms ) ) {
			return '';
		}

		if ( empty( $terms ) ) {
			return '';
		}

		$links = array();

		foreach ( $terms as $term ) {
			$link = get_term_link( $term, $taxonomy );
			if ( is_wp_error( $link ) ) {
				return '';
			}

			$style = '';
			if ( $args['custom_bg_color'] ) {
				$bg_color = get_term_meta( $term->term_id, 'the7_fancy_bg_color', true );
				if ( $bg_color ) {
					$style .= 'background-color:' . $bg_color . ';';
				}
			}

			if ( $args['custom_text_color'] ) {
				$text_color = get_term_meta( $term->term_id, 'the7_fancy_text_color', true );
				if ( $text_color ) {
					$style .= 'color:' . $text_color . ';';
				}
			}

			if ( $style ) {
				$style = ' style="' . esc_attr( $style ) . '"';
			}

			$links[] = '<a href="' . esc_url( $link ) . '" rel="category tag"' . $style . '>' . $term->name . '</a>';
		}

		$term_links = apply_filters( "term_links-{$taxonomy}", $links );

		$sep = '';

		return '<span class="fancy-categories">' . join( $sep, $term_links ) . '</span>';
	}

	/**
	 * Return "Details" button HTML.
	 *
	 * @param string      $btn_style
	 * @param string|null $btn_text
	 *
	 * @return string
	 */
	public static function get_details_btn( $btn_style = 'default', $btn_text = '' ) {
		$btn_classes = array(
			'default_link' => 'details-type-link',
			'default_button' => 'details-type-btn',
		);

		$btn_class = '';
		if ( isset( $btn_classes[ $btn_style ] ) ) {
			$btn_class = ' ' . $btn_classes[ $btn_style ];
		}

		$btn_text .= '<i class="fa fa-caret-right" aria-hidden="true"></i>';

		return presscore_post_details_link( null, 'post-details' . $btn_class, $btn_text );
	}

	/**
	 * Return post image HTML.
	 *
	 * @return bool|mixed|string
	 */
	public static function get_post_image() {
		$thumb_args = apply_filters( 'dt_post_thumbnail_args', array(
			'img_id'	=> get_post_thumbnail_id(),
			'class'		=> 'post-thumbnail-rollover',
			'href'		=> get_permalink(),
			'wrap'		=> '<a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
			'echo'      => false,
		) );

		// Custom lazy loading classes.
		if ( presscore_lazy_loading_enabled() ) {
			$thumb_args['lazy_loading'] = true;
			$thumb_args['img_class'] = 'blog-thumb-lazy-load';
			$thumb_args['class'] .= ' layzr-bg';
		}

		return dt_get_thumb_img( $thumb_args );
	}

	/**
	 * Output posts filter.
	 *
	 * @param array $terms
	 * @param array $class
	 */
	public static function display_posts_filter( $terms, $class = array() ) {
		if ( ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$class[] = 'filter';

		presscore_get_category_list( array(
			'data'  => array(
				'terms'       => $terms,
				'all_count'   => false,
				'other_count' => false,
			),
			'class' => implode( ' ', $class ),
		) );
	}
}