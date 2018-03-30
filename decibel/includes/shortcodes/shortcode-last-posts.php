<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_last_posts_shortcode' ) ) {
	/**
	 * Last Posts shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @param string $type
	 * @return string
	 */
	function wolf_last_posts_shortcode( $atts, $content = null, $type ) {

		// if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
		// 	$atts = vc_map_get_attributes( 'wolf_last_photos_widget', $atts );
		// }
		
		extract( shortcode_atts( array(
			'count' => 3,
			'category' => '',
			'tag' => '',
			'autoplay' => 'yes',
			'transition' => 'auto',
			'slideshow_speed' => 4000,
			'pause_on_hover' => 'yes',
			'nav_bullets' => 'yes',
			'nav_arrows' => 'yes',
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
			'hide_category' => '',
			'hide_tag' => '',
			'hide_date' => '',
			'hide_author' => '',
			'animation' => '',
		), $atts ) );

		$output = $style = '';

		$featured_slider = is_page_template( 'page-templates/home.php' ) || is_front_page();
		$exclude = ( $featured_slider ) ? wolf_get_slider_loop_ids() : array();

		$type = str_replace( 'wolf_last_posts_', '', $type );

		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "last-posts-$type";

		if ( $hide_category )
			$class .= ' hide-category';

		if ( $hide_tag )
			$class .= ' hide-tag';

		if ( $hide_date )
			$class .= ' hide-date';

		if ( $hide_author )
			$class .= ' hide-author';

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output .= "<section class='$class'$style>";

		if ( 'slider' == $type ) {
			$slider_data = "data-pause-on-hover='$autoplay'
			data-autoplay='$autoplay'
			data-transition='$transition'
			data-slideshow-speed='$slideshow_speed'
			data-nav-arrows='$nav_arrows'
			data-nav-bullets='$nav_bullets'";
			$output .= "<div $slider_data class='flexslider'><ul class='slides'>";
		}

		ob_start();

		$args = array(
			'post_type' => array( 'post' ),
			'posts_per_page' => absint( $count ),
			'ignore_sticky_posts' => 1,
			'post__not_in' => $exclude,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => '!=',
					'value' => 'NULL'
				),
			),
		);

		if ( $category ) {
			$args['category_name'] = strtolower( str_replace( ' ', '', $category ) );
		}

		if ( $tag ) {
			$args['tag'] = strtolower( str_replace( ' ', '', $tag ) );
		}

		$animation_class = '';
		if ( $animation )
			$animation_class .= "wow $animation";

		$last_post_loop = new WP_Query( $args );

		if ( $last_post_loop->have_posts() ) :
			while ( $last_post_loop->have_posts() ) : $last_post_loop->the_post();
				if ( 'preview' == $type )
					echo "<div class='$animation_class'>";
				get_template_part( 'partials/post/post', $type . '-content' );

				if ( 'preview' == $type )
					echo '</div>';
			endwhile;
		else :
			echo '<p class="text-center">';
			_e( 'No post found', 'wolf' );
			echo '</p>';

		endif;
		wp_reset_postdata();
		$output .= ob_get_clean();
		if ( 'slider' == $type )
			$output .= '</ul></div>';
		$output .= '</section>';

		return $output;
	}

	$types = array(
		'preview', 'grid', 'slider', 'masonry', 'columns', 'carousel'
	);

	foreach( $types as $type ) {
		add_shortcode( 'wolf_last_posts_' . $type, 'wolf_last_posts_shortcode'  );
	}
}
