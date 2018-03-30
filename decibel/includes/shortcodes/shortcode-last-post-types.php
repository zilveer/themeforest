<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_last_post_types_custom_shortcode' ) ) {
	/**
	 * Last works_custom shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @param string $post_type
	 * @return string
	 */
	function wolf_last_post_types_custom_shortcode( $atts, $content = null, $post_type ) {

		$post_types = array(
			'work', 'video', 'gallery', 'plugins', 'release',
		);
		
		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			foreach( $post_types as $type ) {
				if ( $post_type == $type ) {
					$atts = vc_map_get_attributes( 'wolf_last_posts_' . $post_type, $atts );
				}
			}
		}
		
		extract(
			shortcode_atts(
				array(
					'count' => 4,
					'category' => null,
					'col' => '4',
					'layout' => 'classic',
					'padding' => 'no',
					'carousel' => '',
					'label' => null,
					'band' => null,
					'animation' => null,
				), $atts
			)
		);

		// debug( $padding );

		$layout = wolf_get_image_size( $layout );
		$post_type = str_replace( 'wolf_last_posts_', '', $post_type );
		$col = absint( $col );
		$class = "shortcode-$post_type-grid shortcode-items-grid $post_type-grid-col-$col $post_type-$layout";

		if ( $animation )
			$class .= " wow $animation";

		if ( 'modern' == $layout ) {
			$carousel = false;
		}

		if ( 'yes' == $carousel && 'work' == $post_type ) {
			$class .= " works-carousel";
		}

		if ( 'yes' == $carousel && 'release' == $post_type ) {
			$class .= " releases-carousel";
		}

		if ( 'no' == $padding ) {
			$class .= " $post_type-no-padding";
		}

		if ( 'release' == $post_type ) {
			$layout = 'grid';
			$carousel = false;
		}

		ob_start();

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => absint( $count ),
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => '!=',
					'value' => 'NULL'
				),
			),
		);

		if ( wolf_get_theme_option( $post_type . '_reorder' ) ) {
			$args['order'] = 'DESC';
			$args['meta_key'] = '_position';
			$args['orderby'] = 'meta_value_num';
		}

		if ( 'release' == $post_type ) {
			if ( $label ) {
				$args[ 'label' ] = $label;
			}

			if ( $band ) {
				$args[ 'band' ] = $band;
			}
		}

		if ( $category ) {
			$args[ $post_type . '_type'] = $category;
		}

		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) : ?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php while ( $loop->have_posts() ) : $loop->the_post();

					if ( 'work' == $post_type ) {
						wolf_portfolio_get_template_part( 'content', 'work-' . $layout  );
					} elseif ( 'release' == $post_type ) {
						get_template_part( 'wolf-discography/content', 'release-shortcode' );}
					elseif ( 'video' == $post_type ) {
						get_template_part( 'wolf-videos/content', 'video-shortcode' );
					} else {
						get_template_part( 'wolf-' . $post_type . '/content', $post_type );
					}
				endwhile; ?>
			</div><!-- .shortcode-works-grid -->
		<?php else : // no work ?>
			<p class="text-center"><?php __( 'No post found', 'wolf' ); ?></p>
		<?php endif;
		wp_reset_postdata();

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	$post_types = array(
		'work', 'video', 'gallery', 'plugins', 'release',
	);
	
	foreach( $post_types as $post_type ) {
		add_shortcode( 'wolf_last_posts_' . $post_type, 'wolf_last_post_types_custom_shortcode' );
	}
}
