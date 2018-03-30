<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'woothemes_get_testimonials' ) ) {
/**
 * Wrapper function to get the testimonials from the WooDojo_Testimonials class.
 * @param  string/array $args  Arguments.
 * @since  1.0.0
 * @return array/boolean       Array if true, boolean if false.
 */
function woothemes_get_testimonials ( $args = '' ) {
	global $woothemes_testimonials;
	return $woothemes_testimonials->get_testimonials( $args );
} // End woothemes_get_testimonials()
}

/**
 * Enable the usage of do_action( 'woothemes_testimonials' ) to display testimonials within a theme/plugin.
 *
 * @since  1.0.0
 */
add_action( 'woothemes_testimonials', 'woothemes_testimonials' );

if ( ! function_exists( 'woothemes_testimonials' ) ) {
/**
 * Display or return HTML-formatted testimonials.
 * @param  string/array $args  Arguments.
 * @since  1.0.0
 * @return string
 */
function woothemes_testimonials ( $args = '' ) {
	global $post;

	$defaults = array(
		'limit' => 5,
		'orderby' => 'menu_order',
		'interval' => 10000,
		'order' => 'DESC',
		'id' => 0,
		'display_author' => true,
		'display_avatar' => true,
		'display_url' => true,
		'pagination' => false,
		'echo' => true,
		'size' => 30,
		'title' => '',
		'before' => '',
		'after' => '',
		'before_title' => '',
		'after_title' => '',
		'type' => 'slider',
		'columns' => 3,
		'navigation' => false,
		'category' => 0
	);
	
	$img_size = 40;

	$args = wp_parse_args( $args, $defaults );

	// Allow child themes/plugins to filter here.
	$args = apply_filters( 'woothemes_testimonials_args', $args );
	$html = '';

	do_action( 'woothemes_testimonials_before', $args );

		// The Query.
		$query = woothemes_get_testimonials( $args );

		$class = 'cbp-qtrotator';

		if($args['type'] == 'slider') {
			$class = 'owl-carousel testimonials-slider';
		} elseif($args['type'] == 'grid') {
			$img_size = 60;
			$class = 'testimonial-grid';
		}

		// The Display.
		if ( ! is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {

			$html .= $args['before'] . "\n";
			if ( '' != $args['title'] ) {
				$html .= $args['before_title'] . esc_html( $args['title'] ) . $args['after_title'] . "\n";
			}
			$html .= '<div id="owl-testimonials" class="'.$class.' testimonials" data-navigation="'.$args['navigation'].'" data-interval="'.$args['interval'].'" >' . "\n";

			// Begin templating logic.

			if($args['type'] == 'slider') {
				$tpl = '<div id="quote-%%ID%%" class="item %%CLASS%%"><blockquote class="testimonials-text">%%TEXT%%</blockquote><div class="testimonial-info"> %%AVATAR%% <div class="testimonial-author">%%AUTHOR%%</div></div> <div class="clear"></div></div>';
			} elseif($args['type'] == 'grid') {
				$tpl = '<div id="quote-%%ID%%" class="item col-lg-4 %%CLASS%%"><blockquote class="testimonials-text">%%TEXT%%</blockquote><div class="testimonial-info">%%AVATAR%% <div class="testimonial-author">%%AUTHOR%%</div></div> <div class="clear"></div></div>';
			}
			$tpl = apply_filters( 'woothemes_testimonials_item_template', $tpl, $args );

			$count = 0;
			
			if ($args['type'] == 'grid') {
				$html .= '<div class="row">';
			}

			foreach ( $query as $post ) { $count++;
				$template = $tpl;

				$css_class = 'quote';
				if ( 1 == $count ) { $css_class .= ' first'; }
				if ( count( $query ) == $count ) { $css_class .= ' last'; }

				setup_postdata( $post );

				$author = '';
				$author_text = '';

				// If we need to display the author, get the data.
				if ( ( get_the_title( $post ) != '' ) && true == $args['display_author'] ) {
					$author .= '<cite class="author">';

					$author_name = get_the_title( $post );

					$author .= '<strong>'.$author_name.'</strong>';

					if ( isset( $post->byline ) && '' != $post->byline ) {
						$author .= ' <span class="excerpt">' . $post->byline . '</span><!--/.excerpt-->' . "\n";
					}

					if ( true == $args['display_url'] && '' != $post->url ) {
						$author .= ' <span class="url"><a href="' . esc_url( $post->url ) . '">' . $post->url . '</a></span><!--/.excerpt-->' . "\n";
					}

					$author .= '</cite><!--/.author-->' . "\n";

					// Templating engine replacement.
					$template = str_replace( '%%AUTHOR%%', $author, $template );
				} else {
					$template = str_replace( '%%AUTHOR%%', '', $template );
				}

				// Templating logic replacement.
				$template = str_replace( '%%ID%%', get_the_ID(), $template );
				$template = str_replace( '%%CLASS%%', esc_attr( $css_class ), $template );

				if ( isset( $post->image ) && ( '' != $post->image ) && true == $args['display_avatar'] ) {
					$image = '<img src="' . etheme_get_image(false, $img_size, $img_size, true) . '">';
					$template = str_replace( '%%AVATAR%%', '<a class="avatar-link">' . $image . '</a>', $template );
				} else {
					$template = str_replace( '%%AVATAR%%', '', $template );
				}

				// Remove any remaining %%AVATAR%% template tags.
				$template = str_replace( '%%AVATAR%%', '', $template );
				
				$content = apply_filters( 'woothemes_testimonials_content', get_the_content(), $post );
				$template = str_replace( '%%TEXT%%', $content, $template );

				// Assign for output.
				$html .= $template;
				
				if ($count%$args['columns'] == 0 && count( $query ) != $count && $args['type'] == 'grid') {
					$html .= '<div class="clear"></div></div><div class="row">';
				}
			}
			if ($args['type'] == 'grid') {
				$html .= '<div class="clear"></div></div><!--row-->';
			}


			wp_reset_postdata();


			if ( $args['pagination'] == true && count( $query ) > 1 && $args['effect'] != 'none' ) {
				$html .= '<div class="pagination">' . "\n";
				$html .= '<a href="#" class="btn-prev">' . apply_filters( 'woothemes_testimonials_prev_btn', '&larr; ' . __( 'Previous', ETHEME_DOMAIN ) ) . '</a>' . "\n";
		        $html .= '<a href="#" class="btn-next">' . apply_filters( 'woothemes_testimonials_next_btn', __( 'Next', ETHEME_DOMAIN ) . ' &rarr;' ) . '</a>' . "\n";
		        $html .= '</div><!--/.pagination-->' . "\n";
			}
				
			$html .= '</div><!--/.testimonials-->' . "\n";
			$html .= $args['after'] . "\n";
		}

		// Allow child themes/plugins to filter here.
		$html = apply_filters( 'woothemes_testimonials_html', $html, $query, $args );

		if ( $args['echo'] != true ) { return $html; }

		// Should only run is "echo" is set to true.
		echo $html;

		do_action( 'woothemes_testimonials_after', $args ); // Only if "echo" is set to true.
} // End woothemes_testimonials()
}

if ( ! function_exists( 'woothemes_testimonials_shortcode' ) ) {
/**
 * The shortcode function.
 * @since  1.0.0
 * @param  array  $atts    Shortcode attributes.
 * @param  string $content If the shortcode is a wrapper, this is the content being wrapped.
 * @return string          Output using the template tag.
 */
function woothemes_testimonials_shortcode ( $atts, $content = null ) {
	$args = (array)$atts;

	$defaults = array(
		'limit' => 5,
		'orderby' => 'menu_order',
		'order' => 'DESC',
		'interval' => 10000,
		'id' => 0,
		'display_author' => true,
		'display_avatar' => true,
		'display_url' => true,
		'effect' => 'fade', // Options: 'fade', 'none'
		'pagination' => false,
		'echo' => true,
		'size' => 50,
		'type' => 'slider',
		'navigation' => false,
		'category' => 0
	);

	$args = shortcode_atts( $defaults, $atts );

	// Make sure we return and don't echo.
	$args['echo'] = false;

	// Fix integers.
	if ( isset( $args['limit'] ) ) $args['limit'] = intval( $args['limit'] );
	if ( isset( $args['id'] ) ) $args['id'] = intval( $args['id'] );
	if ( isset( $args['size'] ) &&  ( 0 < intval( $args['size'] ) ) ) $args['size'] = intval( $args['size'] );
	if ( isset( $args['category'] ) && is_numeric( $args['category'] ) ) $args['category'] = intval( $args['category'] );

	// Fix booleans.
	foreach ( array( 'display_author', 'display_url', 'pagination', 'display_avatar' ) as $k => $v ) {
		if ( isset( $args[$v] ) && ( 'true' == $args[$v] ) ) {
			$args[$v] = true;
		} else {
			$args[$v] = false;
		}
	}

	return woothemes_testimonials( $args );
} // End woothemes_testimonials_shortcode()
}

add_shortcode( 'testimonials', 'woothemes_testimonials_shortcode' );

if ( ! function_exists( 'woothemes_testimonials_content_default_filters' ) ) {
/**
 * Adds default filters to the "woothemes_testimonials_content" filter point.
 * @since  1.3.0
 * @return void
 */
function woothemes_testimonials_content_default_filters () {
	add_filter( 'woothemes_testimonials_content', 'do_shortcode' );
} // End woothemes_testimonials_content_default_filters()

add_action( 'woothemes_testimonials_before', 'woothemes_testimonials_content_default_filters' );
}
?>
